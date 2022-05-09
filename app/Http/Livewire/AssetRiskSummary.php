<?php

namespace App\Http\Livewire;

use Illuminate\Auth\Access\AuthorizationException;
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

    protected $listeners = ["threatModified" => "render"];

    /**
     * @throws AuthorizationException
     */
    public function render()
    {
        $this->authorize('update', $this->asset);
        return view('livewire.asset-risk-summary');
    }

    /**
     * @throws AuthorizationException
     */
    public function toggleRemainingRiskAccepted()
    {
        $this->authorize("update", $this->asset);
        $this->asset->update(
            ["remainingRiskAccepted" => !$this->asset->remainingRiskAccepted]
        );
    }
}
