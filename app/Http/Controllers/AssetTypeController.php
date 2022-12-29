<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssetTypeRequest;
use App\Http\Requests\UpdateAssetTypeRequest;
use App\Models\AssetType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class AssetTypeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(AssetType::class, 'asset_type');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $assetTypes = AssetType::all();
        return view("asset-types.index", ["assetTypes" => $assetTypes]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view("asset-types.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAssetTypeRequest $request
     * @return RedirectResponse
     */
    public function store(StoreAssetTypeRequest $request)
    {
        $validated = $request->validated();
        $name = $request->input("name");
        $assetType = new AssetType;
        $assetType->fill(["name" => $name]);
        $assetType->save();
        Log::channel("application")->info(sprintf("Create Asset Type %d (%s)", $assetType->id, $assetType->name));
        return redirect()->route("asset-types.index")->with("status", __("Asset Type Created"));
    }

    /**
     * Display the specified resource.
     *
     * @param AssetType $assetType
     * @return Application|Factory|View
     */
    public function show(AssetType $assetType)
    {
        return view("asset-types.show", ["assetType" => $assetType]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param AssetType $assetType
     * @return Application|Factory|View
     */
    public function edit(AssetType $assetType)
    {
        return view("asset-types.edit", ["assetType" => $assetType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAssetTypeRequest $request
     * @param AssetType $assetType
     * @return RedirectResponse
     */
    public function update(UpdateAssetTypeRequest $request, AssetType $assetType)
    {
        $validated = $request->validated();
        $assetType->update(["name" => $request->input("name")]);
        Log::channel("application")->info(sprintf("Update Asset Type %d (%s)", $assetType->id, $assetType->name));
        return redirect()->route("asset-types.index")->with("status", __("Asset Type Updated"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AssetType $assetType
     * @return RedirectResponse
     */
    public function destroy(AssetType $assetType)
    {
        Log::channel("application")->info(sprintf("Delete Asset Type ID %d (%s)", $assetType->id, $assetType->name));
        $assetType->delete();
        return redirect()->route("asset-types.index")->with("status", __("Asset Type Deleted"));
    }
}
