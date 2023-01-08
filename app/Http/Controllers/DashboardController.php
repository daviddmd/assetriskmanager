<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Asset;
use App\Models\User;
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
        $tasks = array();
        /* @var $user User */
        $user = Auth::user();
        /* @var $asset Asset */
        foreach ($user->assets()->get() as $asset) {
            //Check for non-existent asset valuation
            if ($asset->totalAppreciation() == 0) {
                $tasks[] = array(
                    "asset" => $asset,
                    "message" => __("The asset :name (:id) isn't valued yet. Please set its valuation.",
                        ["name" => $asset->name, "id" => $asset->id]),
                    "tab" => "details-tab"
                );
            }
            //Check for active asset in which the remaining risk isn't accepted
            elseif (!$asset->remainingRiskAccepted && $asset->active) {
                //Check if asset has threats
                if (!$asset->threats()->exists()) {
                    $tasks[] = array(
                        "asset" => $asset,
                        "message" => __("The asset :name (:id) has no threats. Please add some.",
                            ["name" => $asset->name, "id" => $asset->id]),
                        "tab" => "threats-controls-tab"
                    );
                }
                else {
                    foreach ($asset->threats()->get() as $threat) {
                        //Check if any threat of the asset lacks controls
                        if (!$threat->controls()->exists()) {
                            $tasks[] = array(
                                "asset" => $asset,
                                "message" => __("The threat :threat_name associated with asset :name (:id) has no controls. Please add some.",
                                    ["name" => $asset->name, "id" => $asset->id, "threat_name" => $threat->threat->name]),
                                "tab" => "threats-controls-tab"
                            );
                        }
                        else {
                            //Check if a threat that has controls doesn't have its residual/remaining risk accepted after applying them
                            if (!$threat->residual_risk_accepted) {
                                $tasks[] = array(
                                    "asset" => $asset,
                                    "message" => __("The remaining remaining risk associated with threat :threat_name associated with asset :name (:id) isn't accepted. Please accept it.",
                                        ["name" => $asset->name, "id" => $asset->id, "threat_name" => $threat->threat->name]),
                                    "tab" => "risk-summary-tab"
                                );
                            }
                        }
                    }
                }
            }
        }
        //In case the current user is a security officer, pass all the assets that have controls to validatel
        if ($user->role == UserRole::SECURITY_OFFICER) {
            $assetsWithControlsToValidate = Asset::all()->filter(function ($asset) {
                return $asset->hasUnvalidatedControls() && !$asset->remainingRiskAccepted && $asset->active;
            });
        }
        else {
            $assetsWithControlsToValidate = array();
        }
        return view('dashboard', ["assetsWithControlsToValidate" => $assetsWithControlsToValidate, "tasks" => $tasks]);
    }
}
