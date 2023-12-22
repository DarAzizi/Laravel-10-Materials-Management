<?php

namespace Database\Factories;

use App\Models\Jet;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class JetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Jet::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Name' => $this->faker->name(),
            'Description' => $this->faker->sentence(15),
        ];
    }
}
