<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Asset;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function __invoke(Request $request)
    {
        if (Auth::user()->role == UserRole::SECURITY_OFFICER) {
            $assetsWithControlsToValidate = Asset::all()->filter(function ($asset) {
                return $asset->hasUnvalidatedControls() && !$asset->remainingRiskAccepted && $asset->active;
            });
        }
        else {
            $assetsWithControlsToValidate = array();
        }
        return view('dashboard', ["assetsWithControlsToValidate" => $assetsWithControlsToValidate]);
    }
}
