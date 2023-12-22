<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Material;

use App\Models\Nature;
use App\Models\JetPosition;
use App\Models\EquipmentCode;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MaterialTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_materials_list(): void
    {
        $materials = Material::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.materials.index'));

        $response->assertOk()->assertSee($materials[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_material(): void
    {
        $data = Material::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.materials.store'), $data);

        $this->assertDatabaseHas('materials', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_material(): void
    {
        $material = Material::factory()->create();

        $equipmentCode = EquipmentCode::factory()->create();
        $jetPosition = JetPosition::factory()->create();
        $nature = Nature::factory()->create();

        $data = [
            'Name' => $this->faker->name(),
            'ItemCode' => $this->faker->text(255),
            'Description' => $this->faker->sentence(15),
            'Quantity' => $this->faker->randomNumber(),
            'equipment_code_id' => $equipmentCode->id,
            'jet_position_id' => $jetPosition->id,
            'nature_id' => $nature->id,
        ];

        $response = $this->putJson(
            route('api.materials.update', $material),
            $data
        );

        $data['id'] = $material->id;

        $this->assertDatabaseHas('materials', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_material(): void
    {
        $material = Material::factory()->create();

        $response = $this->deleteJson(
            route('api.materials.destroy', $material)
        );

        $this->assertModelMissing($material);

        $response->assertNoContent();
    }
}
