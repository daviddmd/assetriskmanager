<?php

namespace App\Http\Livewire;

use App\Http\Controllers\AssetController;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

/**
 * This livewire component allows the search of an asset for a security officer. This is used in the asset creation
 * form to pre-define the asset that an asset may link to, since there is no need to have strict rules around what
 * assets may be returned in the search (such as not returning assets that are linked to itself, assets that are managed
 * by the own user, asset with the same ID,etc.)
 */
class AssetSearch extends Component
{
    use AuthorizesRequests;

    public $assets = [];
    public $searchTerm;

    /**
     * @throws AuthorizationException
     */
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
        return view('livewire.asset-search', ["assets" => $this->assets]);
    }
}
