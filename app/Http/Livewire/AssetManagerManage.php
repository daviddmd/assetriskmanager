<?php

namespace App\Http\Livewire;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

/**
 * This livewire component is present on the Asset edit/manage page to edit the current manager of an asset.
 * If an asset already has a manager, it'll present the current one with an edit button.
 * On click of the edit button, it'll present the UserSearch Livewire component.
 */
class AssetManagerManage extends Component
{
    use AuthorizesRequests;

    public $asset;
    public $showSearch = false;

    public function mount($asset)
    {
        $this->asset = $asset;
    }

    /**
     * @throws AuthorizationException
     */
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
