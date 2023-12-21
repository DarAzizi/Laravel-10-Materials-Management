<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Project;
use App\Models\Warehouse;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectWarehousesTest extends TestCase
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
    public function it_gets_project_warehouses(): void
    {
        $project = Project::factory()->create();
        $warehouses = Warehouse::factory()
            ->count(2)
            ->create([
                'project_id' => $project->id,
            ]);

        $response = $this->getJson(
            route('api.projects.warehouses.index', $project)
        );

        $response->assertOk()->assertSee($warehouses[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_project_warehouses(): void
    {
        $project = Project::factory()->create();
        $data = Warehouse::factory()
            ->make([
                'project_id' => $project->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.projects.warehouses.store', $project),
            $data
        );

        $this->assertDatabaseHas('warehouses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $warehouse = Warehouse::latest('id')->first();

        $this->assertEquals($project->id, $warehouse->project_id);
    }
}
