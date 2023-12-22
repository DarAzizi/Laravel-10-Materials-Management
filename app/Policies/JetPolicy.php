<?php

namespace App\Policies;

use App\Models\Jet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the jet can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list jets');
    }

    /**
     * Determine whether the jet can view the model.
     */
    public function view(User $user, Jet $model): bool
    {
        return $user->hasPermissionTo('view jets');
    }

    /**
     * Determine whether the jet can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create jets');
    }

    /**
     * Determine whether the jet can update the model.
     */
    public function update(User $user, Jet $model): bool
    {
        return $user->hasPermissionTo('update jets');
    }

    /**
     * Determine whether the jet can delete the model.
     */
    public function delete(User $user, Jet $model): bool
    {
        return $user->hasPermissionTo('delete jets');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete jets');
    }

    /**
     * Determine whether the jet can restore the model.
     */
    public function restore(User $user, Jet $model): bool
    {
        return false;
    }

    /**
     * Determine whether the jet can permanently delete the model.
     */
    public function forceDelete(User $user, Jet $model): bool
    {
        return false;
    }
}
