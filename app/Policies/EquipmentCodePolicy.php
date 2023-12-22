<?php

namespace App\Policies;

use App\Models\User;
use App\Models\EquipmentCode;
use Illuminate\Auth\Access\HandlesAuthorization;

class EquipmentCodePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the equipmentCode can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list equipmentcodes');
    }

    /**
     * Determine whether the equipmentCode can view the model.
     */
    public function view(User $user, EquipmentCode $model): bool
    {
        return $user->hasPermissionTo('view equipmentcodes');
    }

    /**
     * Determine whether the equipmentCode can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create equipmentcodes');
    }

    /**
     * Determine whether the equipmentCode can update the model.
     */
    public function update(User $user, EquipmentCode $model): bool
    {
        return $user->hasPermissionTo('update equipmentcodes');
    }

    /**
     * Determine whether the equipmentCode can delete the model.
     */
    public function delete(User $user, EquipmentCode $model): bool
    {
        return $user->hasPermissionTo('delete equipmentcodes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete equipmentcodes');
    }

    /**
     * Determine whether the equipmentCode can restore the model.
     */
    public function restore(User $user, EquipmentCode $model): bool
    {
        return false;
    }

    /**
     * Determine whether the equipmentCode can permanently delete the model.
     */
    public function forceDelete(User $user, EquipmentCode $model): bool
    {
        return false;
    }
}
