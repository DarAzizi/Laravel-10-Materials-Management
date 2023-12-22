<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\SubSubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubSubCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubSubCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Name' => $this->faker->name(),
            'sub_category_id' => \App\Models\SubCategory::factory(),
        ];
    }
}
