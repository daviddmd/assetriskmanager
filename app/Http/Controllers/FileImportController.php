<?php

namespace App\Http\Controllers;


use App\Enums\UserRole;
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
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class FileImportController extends Controller
{
    public function __invoke(Request $request)
    {
        /* @var $current_user User */
        $current_user = Auth::user();
        if ($request->hasFile('file') && $request->has("model")) {
            $file = $request->file('file');
            $model = $request->input("model");
            switch ($model) {
                case "assets":
                    Excel::import(new AssetsImport, $file);
                    return redirect()->route("assets.index");
                case "asset-types":
                    Excel::import(new AssetTypesImport, $file);
                    return redirect()->route("asset-types.index");
                case "controls":
                    Excel::import(new ControlsImport, $file);
                    return redirect()->route("controls.index");
                case "departments":
                    Excel::import(new DepartmentsImport, $file);
                    return redirect()->route("departments.index");
                case "permanent-contact-points":
                    Excel::import(new PermanentContactPointsImport, $file);
                    return redirect()->route("permanent-contact-points.index");
                case "security-officer":
                    Excel::import(new SecurityOfficersImport, $file);
                    return redirect()->route("security-officer.index");
                case "threats":
                    Excel::import(new ThreatsImport, $file);
                    return redirect()->route("threats.index");
                case "users":
                    if (!config("ldap.enabled") && $current_user->role == UserRole::ADMINISTRATOR) {
                        Excel::import(new UsersImport, $file);
                    }
                    return redirect()->route("users.index");
                default:
                    abort(ResponseAlias::HTTP_BAD_REQUEST);
            }
        }
        abort(ResponseAlias::HTTP_BAD_REQUEST);
    }
}