<?php

namespace App\Livewire;

use App\Enums\UserRole;
use App\Http\Controllers\AssetController;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

/**
 * This livewire component is present on the Asset edit/manage page to edit the current asset that an asset is linked to.
 * If an asset is already linked to another asset, it'll present a hyperlink box with an edit button.
 * On click of the edit button, it'll show a lazy-loading input with a select box, which allows to search for an asset.
 * If the current logged-in user is a security officer, all assets will be returned on search, except for the current one
 * or assets that are linked to itself.
 * If the current logged-in user is a regular asset manager, it'll return the assets that the current user manages,
 * except the current one and assets which are linked to the current asset.
 */
class AssetLinksToManage extends Component
{
    use AuthorizesRequests;

    public $asset;
    public $searchTerm;
    public $assets = array();
    public $showSearch;

    public function mount($asset)
    {
        $this->asset = $asset;
        $this->showSearch = empty($asset->links_to_id);
    }

    /**
     * @throws AuthorizationException
     */
    public function render()
    {
        $this->authorize('update', $this->asset);
        /* @var $user User */
        $user = Auth::user();
        if (!empty($this->searchTerm)) {
            $search = AssetController::filterAsset($this->searchTerm);
            if ($user->role == UserRole::SECURITY_OFFICER) {
                $search = $search->whereNot("id", "=", $this->asset->id)->
                whereNotIn("id", $this->asset->children()->get("id"));
            }
            else {
                $search = $search->whereNot("id", "=", $this->asset->id)->
                whereNotIn("id", $this->asset->children()->get("id"))->
                where("manager_id", "=", $user->id);
            }
            $this->assets = $search->get();
        }
        else {
            $this->assets = array();
        }
        return view('livewire.asset-links-to-manage', ["asset" => $this->asset, "assets" => $this->assets]);
    }

    public function toggleSearch()
    {
        $this->showSearch = true;
    }
}
