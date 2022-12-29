<?php

namespace App\Http\Livewire;

use App\Models\Asset;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class AssetLogs extends Component
{
    use AuthorizesRequests;

    public Asset $asset;
    protected $listeners = ["threatModified" => "render"];

    public function mount($asset)
    {
        $this->asset = $asset;
    }

    public function render()
    {
        $this->authorize("view", $this->asset);
        return view('livewire.asset-logs');
    }
}
