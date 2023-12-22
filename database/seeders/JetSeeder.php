<?php

namespace Database\Seeders;

use App\Models\Jet;
use Illuminate\Database\Seeder;

class JetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jet::factory()
            ->count(5)
            ->create();
    }
}
