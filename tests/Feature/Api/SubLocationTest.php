<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SubLocation;

use App\Models\Location;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubLocationTest extends TestCase
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
    public function it_gets_sub_locations_list(): void
    {
        $subLocations = SubLocation::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.sub-locations.index'));

        $response->assertOk()->assertSee($subLocations[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_sub_location(): void
    {
        $data = SubLocation::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.sub-locations.store'), $data);

        $this->assertDatabaseHas('sub_locations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_sub_location(): void
    {
        $subLocation = SubLocation::factory()->create();

        $location = Location::factory()->create();

        $data = [
            'Name' => $this->faker->name(),
            'location_id' => $location->id,
        ];

        $response = $this->putJson(
            route('api.sub-locations.update', $subLocation),
            $data
        );

        $data['id'] = $subLocation->id;

        $this->assertDatabaseHas('sub_locations', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_sub_location(): void
    {
        $subLocation = SubLocation::factory()->create();

        $response = $this->deleteJson(
            route('api.sub-locations.destroy', $subLocation)
        );

        $this->assertModelMissing($subLocation);

        $response->assertNoContent();
    }
}
