<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Career;
use App\Models\User;

class CareerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Career');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Career $career): bool
    {
        return $user->checkPermissionTo('view Career');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Career');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Career $career): bool
    {
        return $user->checkPermissionTo('update Career');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Career $career): bool
    {
        return $user->checkPermissionTo('delete Career');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Career $career): bool
    {
        return $user->checkPermissionTo('restore Career');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Career $career): bool
    {
        return $user->checkPermissionTo('force-delete Career');
    }
}
