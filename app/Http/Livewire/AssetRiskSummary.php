<?php

namespace App\Http\Livewire;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
    public function toggleRemainingRiskAccepted(Request $request)
    {
        $this->authorize("update", $this->asset);
        Log::info(sprintf("[%s] [Toggled Remaining Risk Acceptance of Asset with ID %s] [%s]", $request->user()->email, $this->asset->id, $request->ip()));

        $this->asset->update(
            ["remainingRiskAccepted" => !$this->asset->remainingRiskAccepted]
        );
    }
}
