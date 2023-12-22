<?php

namespace Database\Factories;

use App\Models\Nature;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class NatureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Nature::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Nature' => 'Consumable',
        ];
    }
}
