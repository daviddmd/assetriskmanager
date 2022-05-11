<?php

namespace App\Http\Livewire;

use App\Enums\AssetOperationType;
use App\Models\AssetLog;
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
        $this->asset->update(
            ["remainingRiskAccepted" => !$this->asset->remainingRiskAccepted]
        );
        AssetLog::create([
            "user_id" => $request->user()->id,
            "asset_id" => $this->asset->id,
            "operation_type" => AssetOperationType::TOGGLE_REMAINING_RISK_ACCEPTANCE,
            "ip" => $request->ip()
        ]);
        Log::channel("application")->info(sprintf("[%s] [Toggle Remaining Risk Acceptance of Asset with ID %s] [%s]", $request->user()->email, $this->asset->id, $request->ip()));
    }
}
