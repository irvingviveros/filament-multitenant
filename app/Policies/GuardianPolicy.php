<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Guardian;
use App\Models\User;

class GuardianPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Guardian');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Guardian $guardian): bool
    {
        return $user->checkPermissionTo('view Guardian');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Guardian');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Guardian $guardian): bool
    {
        return $user->checkPermissionTo('update Guardian');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Guardian $guardian): bool
    {
        return $user->checkPermissionTo('delete Guardian');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Guardian $guardian): bool
    {
        return $user->checkPermissionTo('restore Guardian');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Guardian $guardian): bool
    {
        return $user->checkPermissionTo('force-delete Guardian');
    }
}
