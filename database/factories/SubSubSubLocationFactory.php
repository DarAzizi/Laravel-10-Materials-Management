<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\SubSubSubLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubSubSubLocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubSubSubLocation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Name' => $this->faker->name(),
            'sub_sub_location_id' => \App\Models\SubSubLocation::factory(),
        ];
    }
}
