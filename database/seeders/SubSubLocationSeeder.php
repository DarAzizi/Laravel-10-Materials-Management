<?php

namespace Database\Seeders;

use App\Models\SubSubLocation;
use Illuminate\Database\Seeder;

class SubSubLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubSubLocation::factory()
            ->count(5)
            ->create();
    }
}
