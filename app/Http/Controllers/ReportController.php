<?php

namespace App\Http\Controllers;

use App\Exports\AssetListExport;
use App\Exports\RiskMapExport;
use App\Models\Asset;
use App\Models\AssetThreat;
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
        if (!$request->user()->can("viewAny", User::class)) {
            return abort(403);
        }
        $export = $request->input("export");
        if (!empty($export)) {
            return match ($export) {
                "risk_map" => Excel::download(new RiskMapExport, config("constants.exports.risk_map_file_name")),
                "asset_list" => Excel::download(new AssetListExport, config("constants.exports.asset_list_file_name")),
                default => abort(500),
            };
        } else {
            $nodes_array = array();
            $edges_array = array();
            foreach (Asset::all() as $asset) {
                $data = trim(sprintf("%s\n%s\n%s\n%s", $asset->name, $asset->description, $asset->ip_address, $asset->fqdn));
                $nodes_array[] = array("data" => array(
                    "id" => $asset->id,
                    "data" => $data,
                    "width" => 12 * max(array_map("strlen", explode("\n", $data))),
                    "height" => 30 * count(explode("\n", $data)),
                    "link" => route("assets.edit", $asset->id),
                    "color" => AssetThreat::totalRiskColor($asset->highestRemainingRisk())
                )
                );
                if (!empty($asset->links_to_id)) {
                    $edges_array[] = array("data" => array("source" => $asset->id, "target" => $asset->links_to_id));
                }
            }
            return view("reports.index", [
                "assets" => Asset::all(),
                "nodes_array" => $nodes_array,
                "edges_array" => $edges_array
            ]);
        }
    }
}
