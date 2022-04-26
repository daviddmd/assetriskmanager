<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Asset;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Models\AssetType;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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
    public function index()
    {
        //fixme adicionar query pelo asset type e nome/descricao/etc
        $user = Auth::user();
        if (in_array($user->role, array(UserRole::SECURITY_OFFICER, UserRole::DATA_PROTECTION_OFFICER))) {
            $assets = Asset::paginate(5)->withQueryString();
        } else {
            $assets = Asset::where("manager", $user)->paginate(5)->withQueryString();
        }
        return view("assets.index", ["assets" => $assets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $assetTypes = AssetType::all();
        //fixme migrar isto para livewire
        $users = User::all();
        $assets = Asset::all();
        return view("assets.create", ["assetTypes" => $assetTypes, "users" => $users, "assets" => $assets]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAssetRequest $request
     * @return RedirectResponse
     */
    public function store(StoreAssetRequest $request)
    {
        $validated = $request->validated();
        $asset = new Asset;
        $asset->fill([
            "name" => $request->input("name"),
            "type" => $request->input("type"),
            "manager" => $request->input("manager"),
            "description" => $request->input("description"),
            "sku" => $request->input("sku"),
            "manufacturer" => $request->input("manufacturer"),
            "location" => $request->input("location"),
            "manufacturer_contract_type" => $request->input("manufacturer_contract_type"),
            "manufacturer_contract_beginning_date" => $request->input("manufacturer_contract_beginning_date"),
            "manufacturer_contract_ending_date" => $request->input("manufacturer_contract_ending_date"),
            "manufacturer_contract_provider" => $request->input("manufacturer_contract_provider"),
            "mac_address" => $request->input("mac_address"),
            "ip_address" => $request->input("ip_address"),
            "availability_appreciation" => $request->input("availability_appreciation"),
            "integrity_appreciation" => $request->input("integrity_appreciation"),
            "confidentiality_appreciation" => $request->input("confidentiality_appreciation"),
            "export" => $request->has("export"),
            "links_to" => $request->input("links_to"),
        ]);
        $asset->save();
        return redirect()->route("assets.index")->with("status", "Asset Created");

    }

    /**
     * Display the specified resource.
     *
     * @param Asset $asset
     * @return Application|Factory|View
     */
    public function show(Asset $asset)
    {
        return view("assets.show", ["asset" => $asset]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Asset $asset
     * @return Application|Factory|View
     */
    public function edit(Asset $asset)
    {
        $assetTypes = AssetType::all();
        //fixme migrar isto para livewire
        $users = User::all();
        $assets = Asset::whereNot("id", $asset->id);
        return view("assets.edit", ["asset" => $asset, "assetTypes" => $assetTypes, "users" => $users, "assets" => $assets]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateAssetRequest $request
     * @param Asset $asset
     * @return RedirectResponse
     */
    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        $validated = $request->validated();
        $asset->update([
            "name" => $request->input("name"),
            "type" => $request->input("type"),
            "manager" => $request->input("manager"),
            "description" => $request->input("description"),
            "sku" => $request->input("sku"),
            "manufacturer" => $request->input("manufacturer"),
            "location" => $request->input("location"),
            "manufacturer_contract_type" => $request->input("manufacturer_contract_type"),
            "manufacturer_contract_beginning_date" => $request->input("manufacturer_contract_beginning_date"),
            "manufacturer_contract_ending_date" => $request->input("manufacturer_contract_ending_date"),
            "manufacturer_contract_provider" => $request->input("manufacturer_contract_provider"),
            "mac_address" => $request->input("mac_address"),
            "ip_address" => $request->input("ip_address"),
            "availability_appreciation" => $request->input("availability_appreciation"),
            "integrity_appreciation" => $request->input("integrity_appreciation"),
            "confidentiality_appreciation" => $request->input("confidentiality_appreciation"),
            "export" => $request->input("export"),
            "active" => $request->input("active"),
            "links_to" => $request->input("links_to"),
        ]);
        return redirect()->route("assets.edit", $asset->id)->with("status", "Asset Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Asset $asset
     * @return RedirectResponse
     */
    public function destroy(Asset $asset)
    {
        $asset->delete();
        return redirect()->route("assets.index")->with("status", "Asset Deleted");

    }
}
