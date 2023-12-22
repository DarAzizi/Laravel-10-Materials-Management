<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubSubSubCategory;

class SubSubSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubSubSubCategory::factory()
            ->count(5)
            ->create();
    }
}
