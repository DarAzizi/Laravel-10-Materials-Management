<?php

namespace Tests\Feature\Api;

use App\Models\Jet;
use App\Models\User;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JetTest extends TestCase
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
    public function it_gets_jets_list(): void
    {
        $jets = Jet::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.jets.index'));

        $response->assertOk()->assertSee($jets[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_jet(): void
    {
        $data = Jet::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.jets.store'), $data);

        $this->assertDatabaseHas('jets', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.jets.update', $jet), $data);

        $data['id'] = $jet->id;

        $this->assertDatabaseHas('jets', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_jet(): void
    {
        $jet = Jet::factory()->create();

        $response = $this->deleteJson(route('api.jets.destroy', $jet));

        $this->assertModelMissing($jet);

        $response->assertNoContent();
    }
}
