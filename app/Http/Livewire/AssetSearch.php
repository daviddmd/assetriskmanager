<?php

namespace App\Http\Livewire;

use App\Enums\UserRole;
use App\Http\Controllers\AssetController;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AssetSearch extends Component
{
    use AuthorizesRequests;
    public $assets = [];
    public $searchTerm;
    public function render()
    {
        /*
         * Only the DPO and SO can view any User
         * The Policy is that any user may view an asset, however the assets that they are served are the ones that
         * they manage. However, the DPO and SO can truly view any asset, so the authorization for this endpoint
         * makes use of the viewAny policy for the User Model, since it achieves the same effect.
         */
        $this->authorize('viewAny', User::class);
        if (!empty($this->searchTerm)) {
            $search = AssetController::filterAsset($this->searchTerm)->get();
            $this->assets = $search;
        }
        else {
            $this->assets = array();
        }
        return view('livewire.asset-search',["assets"=>$this->assets]);
    }
}
