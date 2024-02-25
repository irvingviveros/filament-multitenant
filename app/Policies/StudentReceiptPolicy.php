<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\StudentReceipt;
use App\Models\User;

class StudentReceiptPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any StudentReceipt');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, StudentReceipt $studentreceipt): bool
    {
        return $user->checkPermissionTo('view StudentReceipt');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create StudentReceipt');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, StudentReceipt $studentreceipt): bool
    {
        return $user->checkPermissionTo('update StudentReceipt');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, StudentReceipt $studentreceipt): bool
    {
        return $user->checkPermissionTo('delete StudentReceipt');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, StudentReceipt $studentreceipt): bool
    {
        return $user->checkPermissionTo('restore StudentReceipt');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, StudentReceipt $studentreceipt): bool
    {
        return $user->checkPermissionTo('force-delete StudentReceipt');
    }
}
