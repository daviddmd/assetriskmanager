<?php

namespace App\Http\Livewire;

use App\Models\Asset;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class AssetLogs extends Component
{
    use AuthorizesRequests;

    public Asset $asset;

    public function mount($asset)
    {
        $this->asset = $asset;
    }

    protected $listeners = ["threatModified" => "render"];

    public function render()
    {
        $this->authorize("view", $this->asset);
        return view('livewire.asset-logs');
    }
}
