<?php

namespace App\Http\Livewire;

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class AssetManagerManage extends Component
{
    use AuthorizesRequests;

    public $asset;
    public $users = array();
    public $showSearch = false;
    public $searchTerm;

    public function mount($asset)
    {
        $this->asset = $asset;
    }

    public function render()
    {
        $this->authorize('update', $this->asset);
        if (!empty($this->searchTerm)) {
            $filter = $this->searchTerm;
            $this->users = UserController::filterUser($filter)->get();
        }
        else {
            $this->users = array();
        }
        return view('livewire.asset-manager-manage', ["asset" => $this->asset, "users" => $this->users]);
    }

    public function toggleSearch()
    {
        $this->showSearch = true;
    }

}
