<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class AssetManagerManage extends Component
{
    use AuthorizesRequests;

    public $asset;
    public $showSearch = false;

    public function mount($asset)
    {
        $this->asset = $asset;
    }

    public function render()
    {
        $this->authorize('update', $this->asset);

        return view('livewire.asset-manager-manage', ["asset" => $this->asset]);
    }

    public function toggleSearch()
    {
        $this->showSearch = true;
    }

}
