<?php

namespace Database\Factories;

use App\Models\SubLocation;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubLocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubLocation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Name' => $this->faker->name(),
            'location_id' => \App\Models\Location::factory(),
        ];
    }
}
