<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Material;
use App\Models\EquipmentCode;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EquipmentCodeMaterialsTest extends TestCase
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
    public function it_gets_equipment_code_materials(): void
    {
        $equipmentCode = EquipmentCode::factory()->create();
        $materials = Material::factory()
            ->count(2)
            ->create([
                'equipment_code_id' => $equipmentCode->id,
            ]);

        $response = $this->getJson(
            route('api.equipment-codes.materials.index', $equipmentCode)
        );

        $response->assertOk()->assertSee($materials[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_equipment_code_materials(): void
    {
        $equipmentCode = EquipmentCode::factory()->create();
        $data = Material::factory()
            ->make([
                'equipment_code_id' => $equipmentCode->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.equipment-codes.materials.store', $equipmentCode),
            $data
        );

        $this->assertDatabaseHas('materials', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $material = Material::latest('id')->first();

        $this->assertEquals($equipmentCode->id, $material->equipment_code_id);
    }
}
