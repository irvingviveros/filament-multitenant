<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Receipt;
use App\Models\User;

class ReceiptPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Receipt');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Receipt $receipt): bool
    {
        return $user->checkPermissionTo('view Receipt');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Receipt');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Receipt $receipt): bool
    {
        return $user->checkPermissionTo('update Receipt');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Receipt $receipt): bool
    {
        return $user->checkPermissionTo('delete Receipt');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Receipt $receipt): bool
    {
        return $user->checkPermissionTo('restore Receipt');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Receipt $receipt): bool
    {
        return $user->checkPermissionTo('force-delete Receipt');
    }
}
