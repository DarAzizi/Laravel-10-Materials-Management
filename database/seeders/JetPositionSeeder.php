<?php

namespace Database\Seeders;

use App\Models\JetPosition;
use Illuminate\Database\Seeder;

class JetPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JetPosition::factory()
            ->count(5)
            ->create();
    }
}
