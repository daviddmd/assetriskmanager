<?php

namespace App\Http\Livewire;

use App\Enums\UserRole;
use App\Http\Controllers\AssetController;
use App\Models\Asset;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

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

    public function render()
    {
        $this->authorize('update', $this->asset);
        if (!empty($this->searchTerm)) {
            $search = AssetController::filterAsset($this->searchTerm);
            if (Auth::user()->role == UserRole::SECURITY_OFFICER) {
                $search = $search->whereNot("id", "=", $this->asset->id)->
                whereNotIn("id", $this->asset->children()->get("id"))->
                get();
            }
            else {
                $search = $search->whereNot("id", "=", $this->asset->id)->
                whereNotIn("id", $this->asset->children()->get("id"))->
                where("manager_id", "=", Auth::user()->id)->
                orWhere("id", "=", $this->asset->links_to_id)->
                get();
            }
            $this->assets = $search;
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
