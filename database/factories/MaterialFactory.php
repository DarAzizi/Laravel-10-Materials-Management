<?php

namespace Database\Factories;

use App\Models\Material;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Material::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Name' => $this->faker->name(),
            'ItemCode' => $this->faker->text(255),
            'Description' => $this->faker->sentence(15),
            'Quantity' => $this->faker->randomNumber(),
            'equipment_code_id' => \App\Models\EquipmentCode::factory(),
            'jet_position_id' => \App\Models\JetPosition::factory(),
            'nature_id' => \App\Models\Nature::factory(),
        ];
    }
}
