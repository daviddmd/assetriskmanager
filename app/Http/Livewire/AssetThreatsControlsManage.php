<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;


/**
 * This livewire component is responsible for listing and allowing the management the risks and controls of an asset.
 * It allows for linking and unlinking of threats, and linking and unlinking the controls associated with threats on an asset.
 * It'll present a form that allows to search and add threats, and for each threat it'll present the applied controls with all
 * the pivot attributes. All the threats and controls may be added, validated, removed and remaining risk confirmed.
 */
class AssetThreatsControlsManage extends Component
{
    use AuthorizesRequests;

    public $asset;

    public function mount($asset)
    {
        $this->asset = $asset;
    }

    public function render()
    {
        $this->authorize('update', $this->asset);
        return view('livewire.asset-threats-controls-manage', ["asset" => $this->asset]);
    }
}
