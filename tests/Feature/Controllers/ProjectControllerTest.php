<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Project;

use App\Models\City;
use App\Models\Contractor;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectControllerTest extends TestCase
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
    public function it_displays_index_view_with_projects(): void
    {
        $projects = Project::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('projects.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.projects.index')
            ->assertViewHas('projects');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_project(): void
    {
        $response = $this->get(route('projects.create'));

        $response->assertOk()->assertViewIs('app.projects.create');
    }

    /**
     * @test
     */
    public function it_stores_the_project(): void
    {
        $data = Project::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('projects.store'), $data);

        $this->assertDatabaseHas('projects', $data);

        $project = Project::latest('id')->first();

        $response->assertRedirect(route('projects.edit', $project));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_project(): void
    {
        $project = Project::factory()->create();

        $response = $this->get(route('projects.show', $project));

        $response
            ->assertOk()
            ->assertViewIs('app.projects.show')
            ->assertViewHas('project');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_project(): void
    {
        $project = Project::factory()->create();

        $response = $this->get(route('projects.edit', $project));

        $response
            ->assertOk()
            ->assertViewIs('app.projects.edit')
            ->assertViewHas('project');
    }

    /**
     * @test
     */
    public function it_updates_the_project(): void
    {
        $project = Project::factory()->create();

        $city = City::factory()->create();
        $contractor = Contractor::factory()->create();

        $data = [
            'Name' => $this->faker->name(),
            'Description' => $this->faker->sentence(15),
            'city_id' => $city->id,
            'contractor_id' => $contractor->id,
        ];

        $response = $this->put(route('projects.update', $project), $data);

        $data['id'] = $project->id;

        $this->assertDatabaseHas('projects', $data);

        $response->assertRedirect(route('projects.edit', $project));
    }

    /**
     * @test
     */
    public function it_deletes_the_project(): void
    {
        $project = Project::factory()->create();

        $response = $this->delete(route('projects.destroy', $project));

        $response->assertRedirect(route('projects.index'));

        $this->assertModelMissing($project);
    }
}
