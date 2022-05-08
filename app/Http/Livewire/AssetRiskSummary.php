<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class AssetRiskSummary extends Component
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
        return view('livewire.asset-risk-summary'
        );
    }

    public function toggleRemainingRiskAccepted()
    {
        $this->authorize("delete", $this->asset);
        $this->asset->update(
            ["remainingRiskAccepted" => !$this->asset->remainingRiskAccepted]
        );
    }
}
