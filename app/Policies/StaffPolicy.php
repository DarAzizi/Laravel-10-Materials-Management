<?php

namespace App\Policies;

use App\Models\Staff;
use Illuminate\Auth\Access\HandlesAuthorization;

class StaffPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the staff can view any models.
     */
    public function viewAny(Staff $staff): bool
    {
        return $staff->hasPermissionTo('list allstaff');
    }

    /**
     * Determine whether the staff can view the model.
     */
    public function view(Staff $staff, Staff $model): bool
    {
        return $staff->hasPermissionTo('view allstaff');
    }

    /**
     * Determine whether the staff can create models.
     */
    public function create(Staff $staff): bool
    {
        return $staff->hasPermissionTo('create allstaff');
    }

    /**
     * Determine whether the staff can update the model.
     */
    public function update(Staff $staff, Staff $model): bool
    {
        return $staff->hasPermissionTo('update allstaff');
    }

    /**
     * Determine whether the staff can delete the model.
     */
    public function delete(Staff $staff, Staff $model): bool
    {
        return $staff->hasPermissionTo('delete allstaff');
    }

    /**
     * Determine whether the staff can delete multiple instances of the model.
     */
    public function deleteAny(Staff $staff): bool
    {
        return $staff->hasPermissionTo('delete allstaff');
    }

    /**
     * Determine whether the staff can restore the model.
     */
    public function restore(Staff $staff, Staff $model): bool
    {
        return false;
    }

    /**
     * Determine whether the staff can permanently delete the model.
     */
    public function forceDelete(Staff $staff, Staff $model): bool
    {
        return false;
    }
}
