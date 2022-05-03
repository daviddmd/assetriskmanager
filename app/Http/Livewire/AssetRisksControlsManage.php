<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class AssetRisksControlsManage extends Component
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
        return view('livewire.asset-risks-controls-manage', ["asset" => $this->asset]);
    }
}
