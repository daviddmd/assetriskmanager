<?php

namespace App\Http\Livewire;

use App\Enums\AssetOperationType;
use App\Models\Asset;
use App\Models\AssetLog;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AssetRiskSummary extends Component
{
    use AuthorizesRequests;

    public Asset $asset;
    public $canAcceptRemainingRisk;
    protected $listeners = ["threatModified" => "render"];

    public function mount($asset)
    {
        $this->asset = $asset;
    }

    /**
     * @throws AuthorizationException
     */
    public function render()
    {
        $this->canAcceptRemainingRisk = $this->asset->threats()->exists() &&
            !$this->asset->threats()->where("residual_risk_accepted", "=", false)->exists();
        $this->authorize('update', $this->asset);
        return view('livewire.asset-risk-summary', ["canAcceptRemainingRisk" => $this->canAcceptRemainingRisk]);
    }

    /**
     * @throws AuthorizationException
     */
    public function toggleRemainingRiskAccepted(Request $request)
    {

        $this->authorize("update", $this->asset);
        if ($this->canAcceptRemainingRisk) {
            $this->asset->update(
                ["remainingRiskAccepted" => !$this->asset->remainingRiskAccepted]
            );
            AssetLog::create([
                "user_id" => $request->user()->id,
                "asset_id" => $this->asset->id,
                "operation_type" => AssetOperationType::TOGGLE_REMAINING_RISK_ACCEPTANCE,
                "ip" => $request->ip()
            ]);
            Log::channel("application")->info(sprintf("Toggle Remaining Risk Acceptance of Asset %d", $this->asset->id));
        }

    }
}
