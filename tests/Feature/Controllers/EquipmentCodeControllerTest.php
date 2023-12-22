<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\EquipmentCode;

use App\Models\JetPosition;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EquipmentCodeControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_equipment_codes(): void
    {
        $equipmentCodes = EquipmentCode::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('equipment-codes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.equipment_codes.index')
            ->assertViewHas('equipmentCodes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_equipment_code(): void
    {
        $response = $this->get(route('equipment-codes.create'));

        $response->assertOk()->assertViewIs('app.equipment_codes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_equipment_code(): void
    {
        $data = EquipmentCode::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('equipment-codes.store'), $data);

        $this->assertDatabaseHas('equipment_codes', $data);

        $equipmentCode = EquipmentCode::latest('id')->first();

        $response->assertRedirect(
            route('equipment-codes.edit', $equipmentCode)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_equipment_code(): void
    {
        $equipmentCode = EquipmentCode::factory()->create();

        $response = $this->get(route('equipment-codes.show', $equipmentCode));

        $response
            ->assertOk()
            ->assertViewIs('app.equipment_codes.show')
            ->assertViewHas('equipmentCode');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_equipment_code(): void
    {
        $equipmentCode = EquipmentCode::factory()->create();

        $response = $this->get(route('equipment-codes.edit', $equipmentCode));

        $response
            ->assertOk()
            ->assertViewIs('app.equipment_codes.edit')
            ->assertViewHas('equipmentCode');
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

        $response = $this->put(
            route('equipment-codes.update', $equipmentCode),
            $data
        );

        $data['id'] = $equipmentCode->id;

        $this->assertDatabaseHas('equipment_codes', $data);

        $response->assertRedirect(
            route('equipment-codes.edit', $equipmentCode)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_equipment_code(): void
    {
        $equipmentCode = EquipmentCode::factory()->create();

        $response = $this->delete(
            route('equipment-codes.destroy', $equipmentCode)
        );

        $response->assertRedirect(route('equipment-codes.index'));

        $this->assertModelMissing($equipmentCode);
    }
}
