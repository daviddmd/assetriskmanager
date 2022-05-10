<?php

namespace App\Http\Controllers;

use App\Models\AssetType;
use App\Http\Requests\StoreAssetTypeRequest;
use App\Http\Requests\UpdateAssetTypeRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        Log::info(sprintf("[%s] [Create Asset Type with ID %s (%s)] [%s]", $request->user()->email, $assetType->id, $assetType->name, $request->ip()));
        return redirect()->route("asset-types.index")->with("status", "Asset Type Created");
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
        Log::info(sprintf("[%s] [Update Asset Type with ID %s (%s)] [%s]", $request->user()->email, $assetType->id, $assetType->name, $request->ip()));
        return redirect()->route("asset-types.index")->with("status", "Asset Type Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AssetType $assetType
     * @return RedirectResponse
     */
    public function destroy(Request $request, AssetType $assetType)
    {
        Log::info(sprintf("[%s] [Delete Asset Type with ID %s (%s)] [%s]", $request->user()->email, $assetType->id, $assetType->name, $request->ip()));
        $assetType->delete();
        return redirect()->route("asset-types.index")->with("status", "Asset Type Deleted");
    }
}
