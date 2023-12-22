<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list categories']);
        Permission::create(['name' => 'view categories']);
        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'update categories']);
        Permission::create(['name' => 'delete categories']);

        Permission::create(['name' => 'list cities']);
        Permission::create(['name' => 'view cities']);
        Permission::create(['name' => 'create cities']);
        Permission::create(['name' => 'update cities']);
        Permission::create(['name' => 'delete cities']);

        Permission::create(['name' => 'list contractors']);
        Permission::create(['name' => 'view contractors']);
        Permission::create(['name' => 'create contractors']);
        Permission::create(['name' => 'update contractors']);
        Permission::create(['name' => 'delete contractors']);

        Permission::create(['name' => 'list countries']);
        Permission::create(['name' => 'view countries']);
        Permission::create(['name' => 'create countries']);
        Permission::create(['name' => 'update countries']);
        Permission::create(['name' => 'delete countries']);

        Permission::create(['name' => 'list equipmentcodes']);
        Permission::create(['name' => 'view equipmentcodes']);
        Permission::create(['name' => 'create equipmentcodes']);
        Permission::create(['name' => 'update equipmentcodes']);
        Permission::create(['name' => 'delete equipmentcodes']);

        Permission::create(['name' => 'list jets']);
        Permission::create(['name' => 'view jets']);
        Permission::create(['name' => 'create jets']);
        Permission::create(['name' => 'update jets']);
        Permission::create(['name' => 'delete jets']);

        Permission::create(['name' => 'list jetpositions']);
        Permission::create(['name' => 'view jetpositions']);
        Permission::create(['name' => 'create jetpositions']);
        Permission::create(['name' => 'update jetpositions']);
        Permission::create(['name' => 'delete jetpositions']);

        Permission::create(['name' => 'list locations']);
        Permission::create(['name' => 'view locations']);
        Permission::create(['name' => 'create locations']);
        Permission::create(['name' => 'update locations']);
        Permission::create(['name' => 'delete locations']);

        Permission::create(['name' => 'list materials']);
        Permission::create(['name' => 'view materials']);
        Permission::create(['name' => 'create materials']);
        Permission::create(['name' => 'update materials']);
        Permission::create(['name' => 'delete materials']);

        Permission::create(['name' => 'list natures']);
        Permission::create(['name' => 'view natures']);
        Permission::create(['name' => 'create natures']);
        Permission::create(['name' => 'update natures']);
        Permission::create(['name' => 'delete natures']);

        Permission::create(['name' => 'list projects']);
        Permission::create(['name' => 'view projects']);
        Permission::create(['name' => 'create projects']);
        Permission::create(['name' => 'update projects']);
        Permission::create(['name' => 'delete projects']);

        Permission::create(['name' => 'list subcategories']);
        Permission::create(['name' => 'view subcategories']);
        Permission::create(['name' => 'create subcategories']);
        Permission::create(['name' => 'update subcategories']);
        Permission::create(['name' => 'delete subcategories']);

        Permission::create(['name' => 'list sublocations']);
        Permission::create(['name' => 'view sublocations']);
        Permission::create(['name' => 'create sublocations']);
        Permission::create(['name' => 'update sublocations']);
        Permission::create(['name' => 'delete sublocations']);

        Permission::create(['name' => 'list subsubcategories']);
        Permission::create(['name' => 'view subsubcategories']);
        Permission::create(['name' => 'create subsubcategories']);
        Permission::create(['name' => 'update subsubcategories']);
        Permission::create(['name' => 'delete subsubcategories']);

        Permission::create(['name' => 'list subsublocations']);
        Permission::create(['name' => 'view subsublocations']);
        Permission::create(['name' => 'create subsublocations']);
        Permission::create(['name' => 'update subsublocations']);
        Permission::create(['name' => 'delete subsublocations']);

        Permission::create(['name' => 'list subsubsubcategories']);
        Permission::create(['name' => 'view subsubsubcategories']);
        Permission::create(['name' => 'create subsubsubcategories']);
        Permission::create(['name' => 'update subsubsubcategories']);
        Permission::create(['name' => 'delete subsubsubcategories']);

        Permission::create(['name' => 'list subsubsublocations']);
        Permission::create(['name' => 'view subsubsublocations']);
        Permission::create(['name' => 'create subsubsublocations']);
        Permission::create(['name' => 'update subsubsublocations']);
        Permission::create(['name' => 'delete subsubsublocations']);

        Permission::create(['name' => 'list warehouses']);
        Permission::create(['name' => 'view warehouses']);
        Permission::create(['name' => 'create warehouses']);
        Permission::create(['name' => 'update warehouses']);
        Permission::create(['name' => 'delete warehouses']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
