<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\EquipmentCode;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentCodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EquipmentCode::class;

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
            'Drawing' => $this->faker->text(255),
            'jet_position_id' => \App\Models\JetPosition::factory(),
        ];
    }
}
