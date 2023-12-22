<?php

namespace Database\Seeders;

use App\Models\EquipmentCode;
use Illuminate\Database\Seeder;

class EquipmentCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EquipmentCode::factory()
            ->count(5)
            ->create();
    }
}
