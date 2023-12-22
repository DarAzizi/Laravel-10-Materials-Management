<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\JetPosition;

use App\Models\Jet;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JetPositionControllerTest extends TestCase
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
    public function it_displays_index_view_with_jet_positions(): void
    {
        $jetPositions = JetPosition::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('jet-positions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.jet_positions.index')
            ->assertViewHas('jetPositions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_jet_position(): void
    {
        $response = $this->get(route('jet-positions.create'));

        $response->assertOk()->assertViewIs('app.jet_positions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_jet_position(): void
    {
        $data = JetPosition::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('jet-positions.store'), $data);

        $this->assertDatabaseHas('jet_positions', $data);

        $jetPosition = JetPosition::latest('id')->first();

        $response->assertRedirect(route('jet-positions.edit', $jetPosition));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_jet_position(): void
    {
        $jetPosition = JetPosition::factory()->create();

        $response = $this->get(route('jet-positions.show', $jetPosition));

        $response
            ->assertOk()
            ->assertViewIs('app.jet_positions.show')
            ->assertViewHas('jetPosition');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_jet_position(): void
    {
        $jetPosition = JetPosition::factory()->create();

        $response = $this->get(route('jet-positions.edit', $jetPosition));

        $response
            ->assertOk()
            ->assertViewIs('app.jet_positions.edit')
            ->assertViewHas('jetPosition');
    }

    /**
     * @test
     */
    public function it_updates_the_jet_position(): void
    {
        $jetPosition = JetPosition::factory()->create();

        $jet = Jet::factory()->create();

        $data = [
            'Position' => $this->faker->text(255),
            'Description' => $this->faker->sentence(15),
            'jet_id' => $jet->id,
        ];

        $response = $this->put(
            route('jet-positions.update', $jetPosition),
            $data
        );

        $data['id'] = $jetPosition->id;

        $this->assertDatabaseHas('jet_positions', $data);

        $response->assertRedirect(route('jet-positions.edit', $jetPosition));
    }

    /**
     * @test
     */
    public function it_deletes_the_jet_position(): void
    {
        $jetPosition = JetPosition::factory()->create();

        $response = $this->delete(route('jet-positions.destroy', $jetPosition));

        $response->assertRedirect(route('jet-positions.index'));

        $this->assertModelMissing($jetPosition);
    }
}
