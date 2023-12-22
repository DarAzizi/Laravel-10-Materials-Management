<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubSubSubLocation;

class SubSubSubLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubSubSubLocation::factory()
            ->count(5)
            ->create();
    }
}
