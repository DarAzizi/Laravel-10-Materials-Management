<?php

namespace Tests\Feature\Controllers;

use App\Models\Jet;
use App\Models\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JetControllerTest extends TestCase
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
    public function it_displays_index_view_with_jets(): void
    {
        $jets = Jet::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('jets.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.jets.index')
            ->assertViewHas('jets');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_jet(): void
    {
        $response = $this->get(route('jets.create'));

        $response->assertOk()->assertViewIs('app.jets.create');
    }

    /**
     * @test
     */
    public function it_stores_the_jet(): void
    {
        $data = Jet::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('jets.store'), $data);

        $this->assertDatabaseHas('jets', $data);

        $jet = Jet::latest('id')->first();

        $response->assertRedirect(route('jets.edit', $jet));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_jet(): void
    {
        $jet = Jet::factory()->create();

        $response = $this->get(route('jets.show', $jet));

        $response
            ->assertOk()
            ->assertViewIs('app.jets.show')
            ->assertViewHas('jet');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_jet(): void
    {
        $jet = Jet::factory()->create();

        $response = $this->get(route('jets.edit', $jet));

        $response
            ->assertOk()
            ->assertViewIs('app.jets.edit')
            ->assertViewHas('jet');
    }

    /**
     * @test
     */
    public function it_updates_the_jet(): void
    {
        $jet = Jet::factory()->create();

        $data = [
            'Name' => $this->faker->name(),
            'Description' => $this->faker->sentence(15),
        ];

        $response = $this->put(route('jets.update', $jet), $data);

        $data['id'] = $jet->id;

        $this->assertDatabaseHas('jets', $data);

        $response->assertRedirect(route('jets.edit', $jet));
    }

    /**
     * @test
     */
    public function it_deletes_the_jet(): void
    {
        $jet = Jet::factory()->create();

        $response = $this->delete(route('jets.destroy', $jet));

        $response->assertRedirect(route('jets.index'));

        $this->assertModelMissing($jet);
    }
}
