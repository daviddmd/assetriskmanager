<?php

namespace App\Http\Livewire;

use App\Models\AssetThreat;
use App\Models\Threat;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
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

    public $assetThreatEditDialogOpen = false;
    public $assetThreatAddDialogOpen = false;
    public $asset;
    public $threatSearchTerm = "";
    public $threatsSearch = array();
    public $selectedThreat = "";
    public $selectedControl = "";

    public $probability = 0;
    public $availability_impact = 0;
    public $integrity_impact = 0;
    public $confidentiality_impact = 0;
    public $residual_risk = 0;
    public $residual_risk_accepted = "";

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
        $this->residual_risk_accepted = "";
        $this->selectedControl = "";
    }

    public function render()
    {
        $this->authorize('update', $this->asset);
        $threats = $this->asset->threats();
        if (!empty($this->threatSearchTerm)) {
            $filter = $this->threatSearchTerm;
            $this->threatsSearch = Threat::whereNotIn("id", $this->asset->threats()->pluck("threat_id")->toArray())->
            where(function ($query) use ($filter) {
                $query->where("name", "like", "%" . $filter . "%")->orWhere("description", "like", "%" . $filter . "%");
            })->get();
        }
        else {
            $this->threatsSearch = array();
        }
        return view('livewire.asset-threats-controls-manage', [
            "asset" => $this->asset,
            "threats" => $threats->get(),
            "threats_search" => $this->threatsSearch
        ]);
    }

    public function openCreateThreatDialog(){
        $this->resetForm();
        $this->assetThreatAddDialogOpen = true;
    }

    public function addThreat()
    {
        $this->authorize("update", $this->asset);
        $validated = $this->validate([
            "selectedThreat" => [Rule::exists("threats", "id"), "required"],
            "probability" => ["required", "min:1", "max:5"],
            "availability_impact" => ["required", "min:1", "max:5"],
            "confidentiality_impact" => ["required", "min:1", "max:5"],
            "integrity_impact" => ["required", "min:1", "max:5"]
        ]);
        $this->asset->threats()->attach($this->selectedThreat, [
            "probability" => $this->probability,
            "availability_impact" => $this->availability_impact,
            "confidentiality_impact" => $this->confidentiality_impact,
            "integrity_impact" => $this->integrity_impact
        ]);
        $this->assetThreatAddDialogOpen = false;
        $this->resetForm();
    }

    public function removeThreat($id)
    {
        $this->authorize("update", $this->asset);
        $this->asset->threats()->detach($id);

    }

    public function updateThreat()
    {
        $this->authorize("update", $this->asset);
        $validated = $this->validate([
            "probability" => ["required", "min:1", "max:5"],
            "availability_impact" => ["required", "min:1", "max:5"],
            "confidentiality_impact" => ["required", "min:1", "max:5"],
            "integrity_impact" => ["required", "min:1", "max:5"]
        ]);
        $this->asset->threats()->updateExistingPivot($this->selectedThreat, [
            "probability" => $this->probability,
            "availability_impact" => $this->availability_impact,
            "confidentiality_impact" => $this->confidentiality_impact,
            "integrity_impact" => $this->integrity_impact
        ]);
        $this->assetThreatEditDialogOpen = false;
        $this->resetForm();
    }

    public function editThreat($id)
    {
        $this->resetForm();
        $this->authorize("update", $this->asset);
        $asset_threat = AssetThreat::where("id", "=", $id)->first();
        $this->selectedThreat = $asset_threat->threat_id;
        $this->probability = $asset_threat->probability;
        $this->integrity_impact = $asset_threat->integrity_impact;
        $this->availability_impact = $asset_threat->availability_impact;
        $this->confidentiality_impact = $asset_threat->confidentiality_impact;
        $this->assetThreatEditDialogOpen = true;
    }
}
