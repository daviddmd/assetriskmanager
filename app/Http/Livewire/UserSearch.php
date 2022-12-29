<?php

namespace App\Http\Livewire;

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

/**
 * Livewire component to allow searching of all users in the platform. Used on the asset creation and management forms.
 */
class UserSearch extends Component
{
    use AuthorizesRequests;

    public $users = array();
    public $searchTerm;

    /**
     * @throws AuthorizationException
     */
    public function render()
    {
        $this->authorize('viewAny', User::class);
        if (!empty($this->searchTerm)) {
            $filter = $this->searchTerm;
            $this->users = UserController::filterUser($filter)->get();
        } else {
            $this->users = array();
        }
        return view('livewire.user-search', ["users" => $this->users]);
    }
}
