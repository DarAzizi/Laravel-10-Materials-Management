<?php

namespace Tests\Feature\Api;

use App\Models\Jet;
use App\Models\User;
use App\Models\JetPosition;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JetJetPositionsTest extends TestCase
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
    public function it_gets_jet_jet_positions(): void
    {
        $jet = Jet::factory()->create();
        $jetPositions = JetPosition::factory()
            ->count(2)
            ->create([
                'jet_id' => $jet->id,
            ]);

        $response = $this->getJson(route('api.jets.jet-positions.index', $jet));

        $response->assertOk()->assertSee($jetPositions[0]->Position);
    }

    /**
     * @test
     */
    public function it_stores_the_jet_jet_positions(): void
    {
        $jet = Jet::factory()->create();
        $data = JetPosition::factory()
            ->make([
                'jet_id' => $jet->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.jets.jet-positions.store', $jet),
            $data
        );

        $this->assertDatabaseHas('jet_positions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $jetPosition = JetPosition::latest('id')->first();

        $this->assertEquals($jet->id, $jetPosition->jet_id);
    }
}
