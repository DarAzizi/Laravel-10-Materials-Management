<?php

namespace Database\Factories;

use App\Models\Warehouse;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarehouseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Warehouse::class;

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
            'project_id' => \App\Models\Project::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
