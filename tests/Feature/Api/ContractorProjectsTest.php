<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Project;
use App\Models\Contractor;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractorProjectsTest extends TestCase
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
    public function it_gets_contractor_projects(): void
    {
        $contractor = Contractor::factory()->create();
        $projects = Project::factory()
            ->count(2)
            ->create([
                'contractor_id' => $contractor->id,
            ]);

        $response = $this->getJson(
            route('api.contractors.projects.index', $contractor)
        );

        $response->assertOk()->assertSee($projects[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_contractor_projects(): void
    {
        $contractor = Contractor::factory()->create();
        $data = Project::factory()
            ->make([
                'contractor_id' => $contractor->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.contractors.projects.store', $contractor),
            $data
        );

        $this->assertDatabaseHas('projects', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $project = Project::latest('id')->first();

        $this->assertEquals($contractor->id, $project->contractor_id);
    }
}
