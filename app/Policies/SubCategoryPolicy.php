<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SubCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the subCategory can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list subcategories');
    }

    /**
     * Determine whether the subCategory can view the model.
     */
    public function view(User $user, SubCategory $model): bool
    {
        return $user->hasPermissionTo('view subcategories');
    }

    /**
     * Determine whether the subCategory can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create subcategories');
    }

    /**
     * Determine whether the subCategory can update the model.
     */
    public function update(User $user, SubCategory $model): bool
    {
        return $user->hasPermissionTo('update subcategories');
    }

    /**
     * Determine whether the subCategory can delete the model.
     */
    public function delete(User $user, SubCategory $model): bool
    {
        return $user->hasPermissionTo('delete subcategories');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete subcategories');
    }

    /**
     * Determine whether the subCategory can restore the model.
     */
    public function restore(User $user, SubCategory $model): bool
    {
        return false;
    }

    /**
     * Determine whether the subCategory can permanently delete the model.
     */
    public function forceDelete(User $user, SubCategory $model): bool
    {
        return false;
    }
}
