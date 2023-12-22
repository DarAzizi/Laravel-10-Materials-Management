<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JetPosition;

use App\Models\Jet;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JetPositionTest extends TestCase
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
    public function it_gets_jet_positions_list(): void
    {
        $jetPositions = JetPosition::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.jet-positions.index'));

        $response->assertOk()->assertSee($jetPositions[0]->Position);
    }

    /**
     * @test
     */
    public function it_stores_the_jet_position(): void
    {
        $data = JetPosition::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.jet-positions.store'), $data);

        $this->assertDatabaseHas('jet_positions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.jet-positions.update', $jetPosition),
            $data
        );

        $data['id'] = $jetPosition->id;

        $this->assertDatabaseHas('jet_positions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_jet_position(): void
    {
        $jetPosition = JetPosition::factory()->create();

        $response = $this->deleteJson(
            route('api.jet-positions.destroy', $jetPosition)
        );

        $this->assertModelMissing($jetPosition);

        $response->assertNoContent();
    }
}
