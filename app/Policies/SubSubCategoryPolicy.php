<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SubSubCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubSubCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the subSubCategory can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list subsubcategories');
    }

    /**
     * Determine whether the subSubCategory can view the model.
     */
    public function view(User $user, SubSubCategory $model): bool
    {
        return $user->hasPermissionTo('view subsubcategories');
    }

    /**
     * Determine whether the subSubCategory can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create subsubcategories');
    }

    /**
     * Determine whether the subSubCategory can update the model.
     */
    public function update(User $user, SubSubCategory $model): bool
    {
        return $user->hasPermissionTo('update subsubcategories');
    }

    /**
     * Determine whether the subSubCategory can delete the model.
     */
    public function delete(User $user, SubSubCategory $model): bool
    {
        return $user->hasPermissionTo('delete subsubcategories');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete subsubcategories');
    }

    /**
     * Determine whether the subSubCategory can restore the model.
     */
    public function restore(User $user, SubSubCategory $model): bool
    {
        return false;
    }

    /**
     * Determine whether the subSubCategory can permanently delete the model.
     */
    public function forceDelete(User $user, SubSubCategory $model): bool
    {
        return false;
    }
}
