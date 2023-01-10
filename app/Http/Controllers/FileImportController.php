<?php

namespace App\Http\Controllers;


use App\Imports\AssetsImport;
use App\Imports\AssetTypesImport;
use App\Imports\ControlsImport;
use App\Imports\DepartmentsImport;
use App\Imports\PermanentContactPointsImport;
use App\Imports\SecurityOfficersImport;
use App\Imports\ThreatsImport;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FileImportController extends Controller
{
    public function __invoke(Request $request)
    {
        if (!$request->user()->can("viewAny", User::class)) {
            abort(403);
        }
        if ($request->hasFile('file') && $request->has("model")) {
            $file = $request->file('file');
            $model = $request->input("model");
            if ($model == "assets") {
                Excel::import(new AssetsImport, $file);
                return redirect()->route("assets.index");
            }
            else if ($model == "asset-types") {
                Excel::import(new AssetTypesImport, $file);
                return redirect()->route("asset-types.index");
            }
            else if ($model == "controls") {
                Excel::import(new ControlsImport, $file);
                return redirect()->route("controls.index");
            }
            else if ($model == "departments") {
                Excel::import(new DepartmentsImport, $file);
                return redirect()->route("departments.index");
            }
            else if ($model == "permanent-contact-points") {
                Excel::import(new PermanentContactPointsImport, $file);
                return redirect()->route("permanent-contact-points.index");
            }
            else if ($model == "security-officer") {
                Excel::import(new SecurityOfficersImport, $file);
                return redirect()->route("security-officer.index");
            }
            else if ($model == "threats") {
                Excel::import(new ThreatsImport, $file);
                return redirect()->route("threats.index");
            }
            else if ($model == "users" && !config("ldap.enabled")) {
                Excel::import(new UsersImport, $file);
                return redirect()->route("users.index");
            }
        }
        abort(400);
    }
}