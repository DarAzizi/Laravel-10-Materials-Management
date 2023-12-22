<?php

namespace Database\Factories;

use App\Models\JetPosition;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class JetPositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JetPosition::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Position' => $this->faker->text(255),
            'Description' => $this->faker->sentence(15),
            'jet_id' => \App\Models\Jet::factory(),
        ];
    }
}
