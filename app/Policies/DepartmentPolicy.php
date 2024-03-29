<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Department;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
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
     * @param Department $department
     * @return bool
     */
    public function view(User $user, Department $department): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return in_array($user->role, [UserRole::SECURITY_OFFICER, UserRole::ADMINISTRATOR]);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Department $department
     * @return bool
     */
    public function update(User $user, Department $department): bool
    {
        return in_array($user->role, [UserRole::SECURITY_OFFICER, UserRole::ADMINISTRATOR]);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Department $department
     * @return bool
     */
    public function delete(User $user, Department $department): bool
    {
        return in_array($user->role, [UserRole::SECURITY_OFFICER, UserRole::ADMINISTRATOR]);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Department $department
     * @return bool
     */
    public function restore(User $user, Department $department): bool
    {
        return in_array($user->role, [UserRole::SECURITY_OFFICER, UserRole::ADMINISTRATOR]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Department $department
     * @return bool
     */
    public function forceDelete(User $user, Department $department): bool
    {
        return in_array($user->role, [UserRole::SECURITY_OFFICER, UserRole::ADMINISTRATOR]);
    }
}
