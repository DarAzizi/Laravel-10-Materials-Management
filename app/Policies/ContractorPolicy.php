<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Contractor;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContractorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the contractor can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list contractors');
    }

    /**
     * Determine whether the contractor can view the model.
     */
    public function view(User $user, Contractor $model): bool
    {
        return $user->hasPermissionTo('view contractors');
    }

    /**
     * Determine whether the contractor can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create contractors');
    }

    /**
     * Determine whether the contractor can update the model.
     */
    public function update(User $user, Contractor $model): bool
    {
        return $user->hasPermissionTo('update contractors');
    }

    /**
     * Determine whether the contractor can delete the model.
     */
    public function delete(User $user, Contractor $model): bool
    {
        return $user->hasPermissionTo('delete contractors');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete contractors');
    }

    /**
     * Determine whether the contractor can restore the model.
     */
    public function restore(User $user, Contractor $model): bool
    {
        return false;
    }

    /**
     * Determine whether the contractor can permanently delete the model.
     */
    public function forceDelete(User $user, Contractor $model): bool
    {
        return false;
    }
}
