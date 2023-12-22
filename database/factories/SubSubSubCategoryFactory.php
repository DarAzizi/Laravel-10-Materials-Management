<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\SubSubSubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubSubSubCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubSubSubCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Name' => $this->faker->name(),
            'sub_sub_category_id' => \App\Models\SubSubCategory::factory(),
        ];
    }
}
