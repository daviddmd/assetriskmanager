<?php

namespace App\Http\Controllers;

use App\Enums\AssetOperationType;
use App\Enums\ManufacturerContractType;
use App\Enums\UserRole;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Models\Asset;
use App\Models\AssetLog;
use App\Models\AssetType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AssetController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Asset::class, 'asset');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $asset_type_id = $request->input("asset_type", "");
        $filter = $request->input("filter", "");
        $assetTypes = AssetType::all();
        /* @var $user User */
        $user = Auth::user();
        if (!empty($asset_type_id) || !empty($filter)) {
            $assets = $this->filterAsset($filter);
            if (!empty($asset_type_id)) {
                $assets = $assets->where("asset_type_id", "=", $asset_type_id);
            }
            if (!in_array($user->role, array(UserRole::SECURITY_OFFICER, UserRole::DATA_PROTECTION_OFFICER))) {
                $assets = $assets->where("manager_id", "=", $user->id)->where("active", "=", true);
            }
            $assets = $assets->paginate(config("constants.assets.pagination_size"))->withQueryString();
        }
        else {
            if (in_array($user->role, array(UserRole::SECURITY_OFFICER, UserRole::DATA_PROTECTION_OFFICER))) {
                $assets = Asset::paginate(config("constants.assets.pagination_size"))->withQueryString();
            }
            else {
                $assets = Asset::where("manager_id", "=", $user->id)->where("active", "=", true)->paginate(5)->withQueryString();
            }
        }
        return view("assets.index", ["assets" => $assets, "assetTypes" => $assetTypes, "asset_type_id" => $asset_type_id, "filter" => $filter]);
    }

    public static function filterAsset($filter)
    {
        return Asset::where(function ($query) use ($filter) {
            $query
                ->where("name", "like", "%" . $filter . "%")
                ->orWhere("description", "like", "%" . $filter . "%")
                ->orWhere("mac_address", "=", $filter)
                ->orWhere("ip_address", "=", $filter)
                ->orWhere("manufacturer", "like", "%" . $filter . "%")
                ->orWhere("sku", "like", "%" . $filter . "%")
                ->orWhere("location", "like", "%" . $filter . "%")
                ->orWhere("id", "=", $filter)
                ->orWhere("fqdn", "like", "%" . $filter . "%");
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAssetRequest $request
     * @return RedirectResponse
     */
    public function store(StoreAssetRequest $request)
    {
        $manufacturer_contract_type = $request->input("manufacturer_contract_type");
        $asset = new Asset;
        $asset->fill([
            "name" => $request->input("name"),
            "asset_type_id" => $request->input("type"),
            "manager_id" => $request->input("manager"),
            "description" => $request->input("description"),
            "sku" => $request->input("sku"),
            "manufacturer" => $request->input("manufacturer"),
            "location" => $request->input("location"),
            "manufacturer_contract_type" => $manufacturer_contract_type,
            "manufacturer_contract_beginning_date" => empty($request->input("manufacturer_contract_beginning_date")) || $manufacturer_contract_type == ManufacturerContractType::NONE->value ? null : Carbon::createFromFormat("Y-m-d", $request->input("manufacturer_contract_beginning_date")),
            "manufacturer_contract_ending_date" => empty($request->input("manufacturer_contract_ending_date")) || $manufacturer_contract_type == ManufacturerContractType::NONE->value ? null : Carbon::createFromFormat("Y-m-d", $request->input("manufacturer_contract_ending_date")),
            "manufacturer_contract_provider" => $manufacturer_contract_type == ManufacturerContractType::NONE->value ? null : $request->input("manufacturer_contract_provider"),
            "mac_address" => $request->input("mac_address"),
            "fqdn" => $request->input("fqdn"),
            "ip_address" => $request->input("ip_address"),
            "export" => $request->has("export"),
            "links_to_id" => $request->input("links_to"),
            "version" => $request->input("version")
        ]);
        $asset->save();
        AssetLog::create([
            "user_id" => $request->user()->id,
            "asset_id" => $asset->id,
            "operation_type" => AssetOperationType::CREATE,
            "ip" => $request->ip()
        ]);
        Log::channel("application")->info(sprintf("Create Asset %d", $asset->id));
        return redirect()->route("assets.index")->with("status", __("Asset Created"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $assetTypes = AssetType::all();
        return view("assets.create", ["assetTypes" => $assetTypes]);
    }

    /**
     * Display the specified resource.
     *
     * @param Asset $asset
     * @return Application|Factory|View
     */
    public function show(Asset $asset)
    {
        return view("assets.show", ["asset" => $asset, "children" => $asset->availableChildren()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Asset $asset
     * @return Application|Factory|View
     */
    public function edit(Asset $asset)
    {
        return view("assets.edit", [
            "asset" => $asset,
            "assetTypes" => AssetType::all(),
            "children" => $asset->availableChildren()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAssetRequest $request
     * @param Asset $asset
     * @return RedirectResponse
     */
    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        /* @var $user User */
        $user = Auth::user();
        $manufacturer_contract_type = $request->input("manufacturer_contract_type");
        $asset->update([
            "name" => $request->input("name"),
            "asset_type_id" => $request->input("type"),
            "manager_id" => $user->role == UserRole::SECURITY_OFFICER ? $request->input("manager") : $asset->manager_id,
            "description" => $request->input("description"),
            "sku" => $request->input("sku"),
            "manufacturer" => $request->input("manufacturer"),
            "location" => $request->input("location"),
            "manufacturer_contract_type" => $manufacturer_contract_type,
            "manufacturer_contract_beginning_date" => empty($request->input("manufacturer_contract_beginning_date")) || $manufacturer_contract_type == ManufacturerContractType::NONE->value ? null : Carbon::createFromFormat("Y-m-d", $request->input("manufacturer_contract_beginning_date")),
            "manufacturer_contract_ending_date" => empty($request->input("manufacturer_contract_ending_date")) || $manufacturer_contract_type == ManufacturerContractType::NONE->value ? null : Carbon::createFromFormat("Y-m-d", $request->input("manufacturer_contract_ending_date")),
            "manufacturer_contract_provider" => $manufacturer_contract_type == ManufacturerContractType::NONE->value ? null : $request->input("manufacturer_contract_provider"),
            "mac_address" => $request->input("mac_address"),
            "fqdn" => $request->input("fqdn"),
            "ip_address" => $request->input("ip_address"),
            "availability_appreciation" => $request->input("availability_appreciation"),
            "integrity_appreciation" => $request->input("integrity_appreciation"),
            "confidentiality_appreciation" => $request->input("confidentiality_appreciation"),
            "export" => $request->has("export"),
            "active" => $request->has("active"),
            "links_to_id" => $request->input("links_to"),
            "version" => $request->input("version")
        ]);
        Log::channel("application")->info(sprintf("Update Asset %d", $asset->id));
        AssetLog::create([
            "user_id" => $user->id,
            "asset_id" => $asset->id,
            "operation_type" => AssetOperationType::UPDATE,
            "ip" => $request->ip()
        ]);
        return redirect()->route("assets.edit", $asset->id)->with("status", __("Asset Updated"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Asset $asset
     * @return RedirectResponse
     */
    public function destroy(Asset $asset)
    {
        Log::channel("application")->info(sprintf("Delete Asset %d", $asset->id));
        $asset->delete();
        return redirect()->route("assets.index")->with("status", __("Asset Deleted"));

    }
}
