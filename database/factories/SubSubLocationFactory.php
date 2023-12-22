<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\SubSubLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubSubLocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubSubLocation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Name' => $this->faker->name(),
            'sub_location_id' => \App\Models\SubLocation::factory(),
        ];
    }
}
