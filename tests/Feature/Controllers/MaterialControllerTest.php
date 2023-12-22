<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Material;

use App\Models\Nature;
use App\Models\JetPosition;
use App\Models\EquipmentCode;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MaterialControllerTest extends TestCase
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
    public function it_displays_index_view_with_materials(): void
    {
        $materials = Material::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('materials.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.materials.index')
            ->assertViewHas('materials');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_material(): void
    {
        $response = $this->get(route('materials.create'));

        $response->assertOk()->assertViewIs('app.materials.create');
    }

    /**
     * @test
     */
    public function it_stores_the_material(): void
    {
        $data = Material::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('materials.store'), $data);

        $this->assertDatabaseHas('materials', $data);

        $material = Material::latest('id')->first();

        $response->assertRedirect(route('materials.edit', $material));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_material(): void
    {
        $material = Material::factory()->create();

        $response = $this->get(route('materials.show', $material));

        $response
            ->assertOk()
            ->assertViewIs('app.materials.show')
            ->assertViewHas('material');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_material(): void
    {
        $material = Material::factory()->create();

        $response = $this->get(route('materials.edit', $material));

        $response
            ->assertOk()
            ->assertViewIs('app.materials.edit')
            ->assertViewHas('material');
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

        $response = $this->put(route('materials.update', $material), $data);

        $data['id'] = $material->id;

        $this->assertDatabaseHas('materials', $data);

        $response->assertRedirect(route('materials.edit', $material));
    }

    /**
     * @test
     */
    public function it_deletes_the_material(): void
    {
        $material = Material::factory()->create();

        $response = $this->delete(route('materials.destroy', $material));

        $response->assertRedirect(route('materials.index'));

        $this->assertModelMissing($material);
    }
}
