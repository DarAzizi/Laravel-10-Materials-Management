<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Auth\Access\HandlesAuthorization;

class WarehousePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the warehouse can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list warehouses');
    }

    /**
     * Determine whether the warehouse can view the model.
     */
    public function view(User $user, Warehouse $model): bool
    {
        return $user->hasPermissionTo('view warehouses');
    }

    /**
     * Determine whether the warehouse can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create warehouses');
    }

    /**
     * Determine whether the warehouse can update the model.
     */
    public function update(User $user, Warehouse $model): bool
    {
        return $user->hasPermissionTo('update warehouses');
    }

    /**
     * Determine whether the warehouse can delete the model.
     */
    public function delete(User $user, Warehouse $model): bool
    {
        return $user->hasPermissionTo('delete warehouses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete warehouses');
    }

    /**
     * Determine whether the warehouse can restore the model.
     */
    public function restore(User $user, Warehouse $model): bool
    {
        return false;
    }

    /**
     * Determine whether the warehouse can permanently delete the model.
     */
    public function forceDelete(User $user, Warehouse $model): bool
    {
        return false;
    }
}
