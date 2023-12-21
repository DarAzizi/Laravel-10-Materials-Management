<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Warehouse;

use App\Models\Project;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WarehouseControllerTest extends TestCase
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
    public function it_displays_index_view_with_warehouses(): void
    {
        $warehouses = Warehouse::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('warehouses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.warehouses.index')
            ->assertViewHas('warehouses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_warehouse(): void
    {
        $response = $this->get(route('warehouses.create'));

        $response->assertOk()->assertViewIs('app.warehouses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_warehouse(): void
    {
        $data = Warehouse::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('warehouses.store'), $data);

        $this->assertDatabaseHas('warehouses', $data);

        $warehouse = Warehouse::latest('id')->first();

        $response->assertRedirect(route('warehouses.edit', $warehouse));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_warehouse(): void
    {
        $warehouse = Warehouse::factory()->create();

        $response = $this->get(route('warehouses.show', $warehouse));

        $response
            ->assertOk()
            ->assertViewIs('app.warehouses.show')
            ->assertViewHas('warehouse');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_warehouse(): void
    {
        $warehouse = Warehouse::factory()->create();

        $response = $this->get(route('warehouses.edit', $warehouse));

        $response
            ->assertOk()
            ->assertViewIs('app.warehouses.edit')
            ->assertViewHas('warehouse');
    }

    /**
     * @test
     */
    public function it_updates_the_warehouse(): void
    {
        $warehouse = Warehouse::factory()->create();

        $project = Project::factory()->create();
        $user = User::factory()->create();

        $data = [
            'Name' => $this->faker->name(),
            'Description' => $this->faker->sentence(15),
            'project_id' => $project->id,
            'user_id' => $user->id,
        ];

        $response = $this->put(route('warehouses.update', $warehouse), $data);

        $data['id'] = $warehouse->id;

        $this->assertDatabaseHas('warehouses', $data);

        $response->assertRedirect(route('warehouses.edit', $warehouse));
    }

    /**
     * @test
     */
    public function it_deletes_the_warehouse(): void
    {
        $warehouse = Warehouse::factory()->create();

        $response = $this->delete(route('warehouses.destroy', $warehouse));

        $response->assertRedirect(route('warehouses.index'));

        $this->assertModelMissing($warehouse);
    }
}
