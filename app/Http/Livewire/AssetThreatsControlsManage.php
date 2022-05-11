<?php

namespace App\Http\Livewire;

use App\Enums\AssetOperationType;
use App\Enums\ControlType;
use App\Models\AssetLog;
use App\Models\AssetThreat;
use App\Models\AssetThreatControl;
use App\Models\Threat;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;


/**
 * This livewire component is responsible for listing and allowing the management the threats and controls of an asset.
 * It allows for linking and unlinking of threats, and linking and unlinking the controls associated with threats on an asset.
 * It'll present a form that allows to search and add threats, and for each threat it'll present the applied controls with all
 * the pivot attributes. All the threats and controls may be added, validated, removed and remaining risk confirmed.
 */
class AssetThreatsControlsManage extends Component
{
    use AuthorizesRequests;

    public $asset;

    public $assetThreatEditDialogOpen = false;
    public $assetThreatAddDialogOpen = false;
    public $threatSearchTerm = "";
    public $threatsSearch = array();
    public $selectedThreat = "";

    public $probability = 0;
    public $availability_impact = 0;
    public $integrity_impact = 0;
    public $confidentiality_impact = 0;
    public $residual_risk = 0;
    public $total_risk = 0;
    public $residual_risk_accepted = false;

    public $selectedAssetThreat = "";
    public $assetThreatControlAddDialogOpen = false;
    public $availableControls = array();
    public $selectedControl = "";
    public $selectedControlType = "";

    public function mount($asset)
    {
        $this->asset = $asset;
    }

    public function resetForm()
    {
        $this->threatSearchTerm = "";
        $this->selectedThreat = "";

        $this->probability = 0;
        $this->integrity_impact = 0;
        $this->availability_impact = 0;
        $this->confidentiality_impact = 0;
        $this->residual_risk = 0;
        $this->residual_risk_accepted = false;
        $this->total_risk = 0;


        $this->selectedAssetThreat = "";
        $this->selectedControl = "";
        $this->availableControls = array();
        $this->selectedControlType = "";


    }

    /**
     * @throws AuthorizationException
     */
    public function render()
    {
        $this->authorize('update', $this->asset);
        $threats = $this->asset->threats();
        if (!empty($this->threatSearchTerm)) {
            $filter = $this->threatSearchTerm;
            $search = Threat::whereNotIn("id", $this->asset->threats()->pluck("threat_id")->toArray())->
            where(function ($query) use ($filter) {
                $query->where("name", "like", "%" . $filter . "%")->orWhere("description", "like", "%" . $filter . "%");
            })->get();
            if ($search->count() > 0) {
                $this->threatsSearch = $search;
                $this->selectedThreat = $search->get(0)->id;
            }
            else {
                $this->selectedThreat = "";
                $this->threatsSearch = array();
            }
        }
        else {
            $this->threatsSearch = array();
            $this->selectedThreat = "";
        }
        return view('livewire.asset-threats-controls-manage', [
            "asset" => $this->asset,
            "threats" => $threats->get(),
            "threats_search" => $this->threatsSearch
        ]);
    }

    public function openCreateThreatDialog()
    {
        $this->resetForm();
        $this->assetThreatAddDialogOpen = true;
    }

    public function openCreateThreatControlDialog($asset_threat_id)
    {
        $this->resetForm();
        $this->availableControls = AssetThreat::findOrFail($asset_threat_id)->availableControls();
        $this->selectedAssetThreat = $asset_threat_id;
        $this->assetThreatControlAddDialogOpen = true;
    }

    public function unsetRemainingRiskAcceptance()
    {
        $this->asset->update(
            ["remainingRiskAccepted" => false]
        );
        $this->emit("threatModified");
    }

    /**
     * @throws AuthorizationException
     */
    public function addThreat(Request $request)
    {
        $this->authorize("update", $this->asset);
        $validated = $this->validate([
            "selectedThreat" => [Rule::exists("threats", "id"), "required"],
            "probability" => ["required", "min:1", "max:5"],
            "availability_impact" => ["required", "min:1", "max:5"],
            "confidentiality_impact" => ["required", "min:1", "max:5"],
            "integrity_impact" => ["required", "min:1", "max:5"]
        ]);
        AssetThreat::create([
            "asset_id" => $this->asset->id,
            "threat_id" => $this->selectedThreat,
            "probability" => $this->probability,
            "availability_impact" => $this->availability_impact,
            "confidentiality_impact" => $this->confidentiality_impact,
            "integrity_impact" => $this->integrity_impact
        ]);
        $this->unsetRemainingRiskAcceptance();
        $this->assetThreatAddDialogOpen = false;
        AssetLog::create([
            "user_id" => $request->user()->id,
            "asset_id" => $this->asset->id,
            "operation_type" => AssetOperationType::ADD_THREAT,
            "ip" => $request->ip()
        ]);
        Log::channel("application")->info(sprintf("[%s] [Add Threat with ID %s to Asset with ID %s] [%s]", $request->user()->email, $this->selectedThreat, $this->asset->id, $request->ip()));
    }

    /**
     * @throws AuthorizationException
     */
    public function removeThreat(Request $request, $id)
    {
        $this->authorize("update", $this->asset);
        $assetThreat = AssetThreat::findOrFail($id);
        $assetThreat->delete();
        $this->unsetRemainingRiskAcceptance();
        AssetLog::create([
            "user_id" => $request->user()->id,
            "asset_id" => $this->asset->id,
            "operation_type" => AssetOperationType::REMOVE_THREAT,
            "ip" => $request->ip()
        ]);
        Log::channel("application")->info(sprintf("[%s] [Remove Threat with ID %s from Asset with ID %s] [%s]", $request->user()->email, $assetThreat->threat_id, $this->asset->id, $request->ip()));

    }

    /**
     * @throws AuthorizationException
     */
    public function updateThreat(Request $request)
    {
        $this->authorize("update", $this->asset);
        $validated = $this->validate([
            "probability" => ["required", "min:1", "max:5"],
            "availability_impact" => ["required", "min:1", "max:5"],
            "confidentiality_impact" => ["required", "min:1", "max:5"],
            "integrity_impact" => ["required", "min:1", "max:5"],
            "residual_risk" => ["required", "min:0", "max:125"]
        ]);
        $assetThreat = AssetThreat::findOrFail($this->selectedAssetThreat);
        $assetThreat->update(
            [
                "probability" => $this->probability,
                "availability_impact" => $this->availability_impact,
                "confidentiality_impact" => $this->confidentiality_impact,
                "integrity_impact" => $this->integrity_impact,
                "residual_risk" => $this->residual_risk_accepted ? $this->residual_risk : 0,
                "residual_risk_accepted" => $this->residual_risk_accepted
            ]
        );
        $this->unsetRemainingRiskAcceptance();
        $this->assetThreatEditDialogOpen = false;
        AssetLog::create([
            "user_id" => $request->user()->id,
            "asset_id" => $this->asset->id,
            "operation_type" => AssetOperationType::UPDATE_THREAT,
            "ip" => $request->ip()
        ]);
        Log::channel("application")->info(sprintf("[%s] [Update Threat Details with ID %s on Asset with ID %s] [%s]", $request->user()->email, $assetThreat->threat_id, $this->asset->id, $request->ip()));
    }

    /**
     * @throws AuthorizationException
     */
    public function editThreat($id)
    {
        $this->authorize("update", $this->asset);
        $this->resetForm();
        $asset_threat = AssetThreat::findOrFail($id);
        $this->selectedAssetThreat = $id;
        $this->probability = $asset_threat->probability;
        $this->integrity_impact = $asset_threat->integrity_impact;
        $this->availability_impact = $asset_threat->availability_impact;
        $this->confidentiality_impact = $asset_threat->confidentiality_impact;
        $this->residual_risk = $asset_threat->residual_risk;
        $this->residual_risk_accepted = $asset_threat->residual_risk_accepted;
        $this->assetThreatEditDialogOpen = true;
        $this->total_risk = $asset_threat->absoluteRisk() * $this->asset->totalAppreciation();
    }

    /**
     * @throws AuthorizationException
     */
    public function addControl(Request $request)
    {
        $this->authorize("update", $this->asset);
        $validated = $this->validate([
            "selectedAssetThreat" => [Rule::exists("asset_threats", "id"), "required"],
            "selectedControl" => [Rule::exists("controls", "id"), "required"],
            "selectedControlType" => ["required", new Enum(ControlType::class)],
        ]);
        AssetThreatControl::create([
            "asset_threat_id" => $this->selectedAssetThreat,
            "control_id" => $this->selectedControl,
            "control_type" => $this->selectedControlType
        ]);
        $this->unsetRemainingRiskAcceptance();
        $this->assetThreatControlAddDialogOpen = false;
        AssetLog::create([
            "user_id" => $request->user()->id,
            "asset_id" => $this->asset->id,
            "operation_type" => AssetOperationType::ADD_CONTROL,
            "ip" => $request->ip()
        ]);
        Log::channel("application")->info(sprintf("[%s] [Add Control with ID %s to Asset with ID %s] [%s]", $request->user()->email, $this->selectedControl, $this->asset->id, $request->ip()));
    }

    /**
     * @throws AuthorizationException
     */
    public function removeControl(Request $request, $control_id)
    {
        $this->authorize("update", $this->asset);
        $assetThreatControl = AssetThreatControl::findOrFail($control_id);
        $assetThreatControl->delete();
        $this->unsetRemainingRiskAcceptance();
        AssetLog::create([
            "user_id" => $request->user()->id,
            "asset_id" => $this->asset->id,
            "operation_type" => AssetOperationType::REMOVE_CONTROL,
            "ip" => $request->ip()
        ]);
        Log::channel("application")->info(sprintf("[%s] [Remove Control with ID %s from Asset with ID %s] [%s]", $request->user()->email, $assetThreatControl->control_id, $this->asset->id, $request->ip()));

    }

    /**
     * @param Request $request
     * @param $asset_threat_control_id
     * @return void
     * Only the Security Officer may Validate a Control, so the permission to delete an asset is used instead.
     * @throws AuthorizationException
     */
    public function toggleValidationControl(Request $request, $asset_threat_control_id)
    {
        $this->authorize("delete", $this->asset);
        $asset_threat_control = AssetThreatControl::findOrFail($asset_threat_control_id);
        $asset_threat_control->update([
            "validated" => !$asset_threat_control->validated
        ]);
        $this->unsetRemainingRiskAcceptance();
        AssetLog::create([
            "user_id" => $request->user()->id,
            "asset_id" => $this->asset->id,
            "operation_type" => AssetOperationType::TOGGLE_CONTROL_VALIDATION,
            "ip" => $request->ip()
        ]);
        Log::channel("application")->info(sprintf("[%s] [Toggle Validation of Control with ID %s on Asset with ID %s] [%s]", $request->user()->email, $asset_threat_control->control_id, $this->asset->id, $request->ip()));
    }
}
