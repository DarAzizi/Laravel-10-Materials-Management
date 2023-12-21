<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the project can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list projects');
    }

    /**
     * Determine whether the project can view the model.
     */
    public function view(User $user, Project $model): bool
    {
        return $user->hasPermissionTo('view projects');
    }

    /**
     * Determine whether the project can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create projects');
    }

    /**
     * Determine whether the project can update the model.
     */
    public function update(User $user, Project $model): bool
    {
        return $user->hasPermissionTo('update projects');
    }

    /**
     * Determine whether the project can delete the model.
     */
    public function delete(User $user, Project $model): bool
    {
        return $user->hasPermissionTo('delete projects');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete projects');
    }

    /**
     * Determine whether the project can restore the model.
     */
    public function restore(User $user, Project $model): bool
    {
        return false;
    }

    /**
     * Determine whether the project can permanently delete the model.
     */
    public function forceDelete(User $user, Project $model): bool
    {
        return false;
    }
}
