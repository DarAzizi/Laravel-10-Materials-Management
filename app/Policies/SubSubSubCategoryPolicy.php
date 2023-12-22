<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SubSubSubCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubSubSubCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the subSubSubCategory can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list subsubsubcategories');
    }

    /**
     * Determine whether the subSubSubCategory can view the model.
     */
    public function view(User $user, SubSubSubCategory $model): bool
    {
        return $user->hasPermissionTo('view subsubsubcategories');
    }

    /**
     * Determine whether the subSubSubCategory can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create subsubsubcategories');
    }

    /**
     * Determine whether the subSubSubCategory can update the model.
     */
    public function update(User $user, SubSubSubCategory $model): bool
    {
        return $user->hasPermissionTo('update subsubsubcategories');
    }

    /**
     * Determine whether the subSubSubCategory can delete the model.
     */
    public function delete(User $user, SubSubSubCategory $model): bool
    {
        return $user->hasPermissionTo('delete subsubsubcategories');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete subsubsubcategories');
    }

    /**
     * Determine whether the subSubSubCategory can restore the model.
     */
    public function restore(User $user, SubSubSubCategory $model): bool
    {
        return false;
    }

    /**
     * Determine whether the subSubSubCategory can permanently delete the model.
     */
    public function forceDelete(User $user, SubSubSubCategory $model): bool
    {
        return false;
    }
}
