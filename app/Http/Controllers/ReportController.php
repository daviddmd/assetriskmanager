<?php

namespace App\Http\Controllers;

use App\Exports\AssetListExport;
use App\Exports\RiskMapExport;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Application|Factory|View|BinaryFileResponse
     */

    public function __invoke(Request $request)
    {
        $export = $request->input("export");
        if (!empty($export)) {
            return match ($export) {
                "risk_map" => Excel::download(new RiskMapExport, config("constants.exports.risk_map_file_name")),
                "asset_list" => Excel::download(new AssetListExport, config("constants.exports.asset_list_file_name")),
                default => abort(500),
            };
        }
        else {
            return $request->user()->can("viewAny", User::class) ? view("reports.index", ["assets" => Asset::all()]) : abort(403);
        }
    }
}
