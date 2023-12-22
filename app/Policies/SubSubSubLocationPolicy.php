<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SubSubSubLocation;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubSubSubLocationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the subSubSubLocation can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list subsubsublocations');
    }

    /**
     * Determine whether the subSubSubLocation can view the model.
     */
    public function view(User $user, SubSubSubLocation $model): bool
    {
        return $user->hasPermissionTo('view subsubsublocations');
    }

    /**
     * Determine whether the subSubSubLocation can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create subsubsublocations');
    }

    /**
     * Determine whether the subSubSubLocation can update the model.
     */
    public function update(User $user, SubSubSubLocation $model): bool
    {
        return $user->hasPermissionTo('update subsubsublocations');
    }

    /**
     * Determine whether the subSubSubLocation can delete the model.
     */
    public function delete(User $user, SubSubSubLocation $model): bool
    {
        return $user->hasPermissionTo('delete subsubsublocations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete subsubsublocations');
    }

    /**
     * Determine whether the subSubSubLocation can restore the model.
     */
    public function restore(User $user, SubSubSubLocation $model): bool
    {
        return false;
    }

    /**
     * Determine whether the subSubSubLocation can permanently delete the model.
     */
    public function forceDelete(User $user, SubSubSubLocation $model): bool
    {
        return false;
    }
}
