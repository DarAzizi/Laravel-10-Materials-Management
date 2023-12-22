<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JetPosition;
use Illuminate\Auth\Access\HandlesAuthorization;

class JetPositionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the jetPosition can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list jetpositions');
    }

    /**
     * Determine whether the jetPosition can view the model.
     */
    public function view(User $user, JetPosition $model): bool
    {
        return $user->hasPermissionTo('view jetpositions');
    }

    /**
     * Determine whether the jetPosition can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create jetpositions');
    }

    /**
     * Determine whether the jetPosition can update the model.
     */
    public function update(User $user, JetPosition $model): bool
    {
        return $user->hasPermissionTo('update jetpositions');
    }

    /**
     * Determine whether the jetPosition can delete the model.
     */
    public function delete(User $user, JetPosition $model): bool
    {
        return $user->hasPermissionTo('delete jetpositions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete jetpositions');
    }

    /**
     * Determine whether the jetPosition can restore the model.
     */
    public function restore(User $user, JetPosition $model): bool
    {
        return false;
    }

    /**
     * Determine whether the jetPosition can permanently delete the model.
     */
    public function forceDelete(User $user, JetPosition $model): bool
    {
        return false;
    }
}
