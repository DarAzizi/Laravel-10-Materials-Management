<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Nature;
use Illuminate\Auth\Access\HandlesAuthorization;

class NaturePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the nature can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list natures');
    }

    /**
     * Determine whether the nature can view the model.
     */
    public function view(User $user, Nature $model): bool
    {
        return $user->hasPermissionTo('view natures');
    }

    /**
     * Determine whether the nature can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create natures');
    }

    /**
     * Determine whether the nature can update the model.
     */
    public function update(User $user, Nature $model): bool
    {
        return $user->hasPermissionTo('update natures');
    }

    /**
     * Determine whether the nature can delete the model.
     */
    public function delete(User $user, Nature $model): bool
    {
        return $user->hasPermissionTo('delete natures');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete natures');
    }

    /**
     * Determine whether the nature can restore the model.
     */
    public function restore(User $user, Nature $model): bool
    {
        return false;
    }

    /**
     * Determine whether the nature can permanently delete the model.
     */
    public function forceDelete(User $user, Nature $model): bool
    {
        return false;
    }
}
