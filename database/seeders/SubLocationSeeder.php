<?php

namespace Database\Seeders;

use App\Models\SubLocation;
use Illuminate\Database\Seeder;

class SubLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubLocation::factory()
            ->count(5)
            ->create();
    }
}
