<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(CategorySeeder::class);
        $this->call(CitySeeder::class);
        $this->call(ContractorSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(EquipmentCodeSeeder::class);
        $this->call(JetSeeder::class);
        $this->call(JetPositionSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(MaterialSeeder::class);
        $this->call(NatureSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(SubCategorySeeder::class);
        $this->call(SubLocationSeeder::class);
        $this->call(SubSubCategorySeeder::class);
        $this->call(SubSubLocationSeeder::class);
        $this->call(SubSubSubCategorySeeder::class);
        $this->call(SubSubSubLocationSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WarehouseSeeder::class);
    }
}
