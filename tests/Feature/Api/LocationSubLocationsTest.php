<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Location;
use App\Models\SubLocation;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationSubLocationsTest extends TestCase
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
    public function it_gets_location_sub_locations(): void
    {
        $location = Location::factory()->create();
        $subLocations = SubLocation::factory()
            ->count(2)
            ->create([
                'location_id' => $location->id,
            ]);

        $response = $this->getJson(
            route('api.locations.sub-locations.index', $location)
        );

        $response->assertOk()->assertSee($subLocations[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_location_sub_locations(): void
    {
        $location = Location::factory()->create();
        $data = SubLocation::factory()
            ->make([
                'location_id' => $location->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.locations.sub-locations.store', $location),
            $data
        );

        $this->assertDatabaseHas('sub_locations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $subLocation = SubLocation::latest('id')->first();

        $this->assertEquals($location->id, $subLocation->location_id);
    }
}
