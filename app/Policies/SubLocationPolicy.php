<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SubLocation;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubLocationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the subLocation can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list sublocations');
    }

    /**
     * Determine whether the subLocation can view the model.
     */
    public function view(User $user, SubLocation $model): bool
    {
        return $user->hasPermissionTo('view sublocations');
    }

    /**
     * Determine whether the subLocation can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create sublocations');
    }

    /**
     * Determine whether the subLocation can update the model.
     */
    public function update(User $user, SubLocation $model): bool
    {
        return $user->hasPermissionTo('update sublocations');
    }

    /**
     * Determine whether the subLocation can delete the model.
     */
    public function delete(User $user, SubLocation $model): bool
    {
        return $user->hasPermissionTo('delete sublocations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete sublocations');
    }

    /**
     * Determine whether the subLocation can restore the model.
     */
    public function restore(User $user, SubLocation $model): bool
    {
        return false;
    }

    /**
     * Determine whether the subLocation can permanently delete the model.
     */
    public function forceDelete(User $user, SubLocation $model): bool
    {
        return false;
    }
}
