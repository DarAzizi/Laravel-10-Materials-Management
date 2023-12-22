<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JetPosition;
use App\Models\EquipmentCode;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JetPositionEquipmentCodesTest extends TestCase
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
    public function it_gets_jet_position_equipment_codes(): void
    {
        $jetPosition = JetPosition::factory()->create();
        $equipmentCodes = EquipmentCode::factory()
            ->count(2)
            ->create([
                'jet_position_id' => $jetPosition->id,
            ]);

        $response = $this->getJson(
            route('api.jet-positions.equipment-codes.index', $jetPosition)
        );

        $response->assertOk()->assertSee($equipmentCodes[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_jet_position_equipment_codes(): void
    {
        $jetPosition = JetPosition::factory()->create();
        $data = EquipmentCode::factory()
            ->make([
                'jet_position_id' => $jetPosition->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.jet-positions.equipment-codes.store', $jetPosition),
            $data
        );

        $this->assertDatabaseHas('equipment_codes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $equipmentCode = EquipmentCode::latest('id')->first();

        $this->assertEquals($jetPosition->id, $equipmentCode->jet_position_id);
    }
}
