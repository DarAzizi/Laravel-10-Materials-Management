<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SubSubLocation;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubSubLocationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the subSubLocation can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list subsublocations');
    }

    /**
     * Determine whether the subSubLocation can view the model.
     */
    public function view(User $user, SubSubLocation $model): bool
    {
        return $user->hasPermissionTo('view subsublocations');
    }

    /**
     * Determine whether the subSubLocation can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create subsublocations');
    }

    /**
     * Determine whether the subSubLocation can update the model.
     */
    public function update(User $user, SubSubLocation $model): bool
    {
        return $user->hasPermissionTo('update subsublocations');
    }

    /**
     * Determine whether the subSubLocation can delete the model.
     */
    public function delete(User $user, SubSubLocation $model): bool
    {
        return $user->hasPermissionTo('delete subsublocations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete subsublocations');
    }

    /**
     * Determine whether the subSubLocation can restore the model.
     */
    public function restore(User $user, SubSubLocation $model): bool
    {
        return false;
    }

    /**
     * Determine whether the subSubLocation can permanently delete the model.
     */
    public function forceDelete(User $user, SubSubLocation $model): bool
    {
        return false;
    }
}
