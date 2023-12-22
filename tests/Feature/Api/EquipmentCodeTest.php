<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\EquipmentCode;

use App\Models\JetPosition;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EquipmentCodeTest extends TestCase
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
    public function it_gets_equipment_codes_list(): void
    {
        $equipmentCodes = EquipmentCode::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.equipment-codes.index'));

        $response->assertOk()->assertSee($equipmentCodes[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_equipment_code(): void
    {
        $data = EquipmentCode::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.equipment-codes.store'), $data);

        $this->assertDatabaseHas('equipment_codes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_equipment_code(): void
    {
        $equipmentCode = EquipmentCode::factory()->create();

        $jetPosition = JetPosition::factory()->create();

        $data = [
            'Name' => $this->faker->name(),
            'Description' => $this->faker->sentence(15),
            'Drawing' => $this->faker->text(255),
            'jet_position_id' => $jetPosition->id,
        ];

        $response = $this->putJson(
            route('api.equipment-codes.update', $equipmentCode),
            $data
        );

        $data['id'] = $equipmentCode->id;

        $this->assertDatabaseHas('equipment_codes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_equipment_code(): void
    {
        $equipmentCode = EquipmentCode::factory()->create();

        $response = $this->deleteJson(
            route('api.equipment-codes.destroy', $equipmentCode)
        );

        $this->assertModelMissing($equipmentCode);

        $response->assertNoContent();
    }
}
