<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SubLocation;
use App\Models\SubSubLocation;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubLocationSubSubLocationsTest extends TestCase
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
    public function it_gets_sub_location_sub_sub_locations(): void
    {
        $subLocation = SubLocation::factory()->create();
        $subSubLocations = SubSubLocation::factory()
            ->count(2)
            ->create([
                'sub_location_id' => $subLocation->id,
            ]);

        $response = $this->getJson(
            route('api.sub-locations.sub-sub-locations.index', $subLocation)
        );

        $response->assertOk()->assertSee($subSubLocations[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_sub_location_sub_sub_locations(): void
    {
        $subLocation = SubLocation::factory()->create();
        $data = SubSubLocation::factory()
            ->make([
                'sub_location_id' => $subLocation->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.sub-locations.sub-sub-locations.store', $subLocation),
            $data
        );

        $this->assertDatabaseHas('sub_sub_locations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $subSubLocation = SubSubLocation::latest('id')->first();

        $this->assertEquals($subLocation->id, $subSubLocation->sub_location_id);
    }
}
