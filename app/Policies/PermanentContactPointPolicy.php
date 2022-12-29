<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\PermanentContactPoint;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermanentContactPointPolicy
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
        return $user->role == UserRole::SECURITY_OFFICER;

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param PermanentContactPoint $permanentContactPoint
     * @return bool
     */
    public function view(User $user, PermanentContactPoint $permanentContactPoint): bool
    {
        return $user->role == UserRole::SECURITY_OFFICER;
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
     * @param PermanentContactPoint $permanentContactPoint
     * @return bool
     */
    public function update(User $user, PermanentContactPoint $permanentContactPoint): bool
    {
        return $user->role == UserRole::SECURITY_OFFICER;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param PermanentContactPoint $permanentContactPoint
     * @return bool
     */
    public function delete(User $user, PermanentContactPoint $permanentContactPoint): bool
    {
        return $user->role == UserRole::SECURITY_OFFICER;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param PermanentContactPoint $permanentContactPoint
     * @return bool
     */
    public function restore(User $user, PermanentContactPoint $permanentContactPoint): bool
    {
        return $user->role == UserRole::SECURITY_OFFICER;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param PermanentContactPoint $permanentContactPoint
     * @return bool
     */
    public function forceDelete(User $user, PermanentContactPoint $permanentContactPoint): bool
    {
        return $user->role == UserRole::SECURITY_OFFICER;
    }
}
