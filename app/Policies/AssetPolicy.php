<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Asset $asset
     * @return bool
     */
    public function view(User $user, Asset $asset): bool
    {
        return in_array($user->role, array(UserRole::SECURITY_OFFICER, UserRole::DATA_PROTECTION_OFFICER)) || $asset->manager == $user;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->role == UserRole::SECURITY_OFFICER;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Asset $asset
     * @return bool
     */
    public function update(User $user, Asset $asset): bool
    {
        return $user->role == UserRole::SECURITY_OFFICER || $asset->manager == $user;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Asset $asset
     * @return bool
     */
    public function delete(User $user, Asset $asset): bool
    {
        return $user->role == UserRole::SECURITY_OFFICER;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Asset $asset
     * @return bool
     */
    public function restore(User $user, Asset $asset): bool
    {
        return $user->role == UserRole::SECURITY_OFFICER;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Asset $asset
     * @return bool
     */
    public function forceDelete(User $user, Asset $asset): bool
    {
        return $user->role == UserRole::SECURITY_OFFICER;
    }
}
