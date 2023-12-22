<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SubSubLocation;
use App\Models\SubSubSubLocation;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubSubLocationSubSubSubLocationsTest extends TestCase
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
    public function it_gets_sub_sub_location_sub_sub_sub_locations(): void
    {
        $subSubLocation = SubSubLocation::factory()->create();
        $subSubSubLocations = SubSubSubLocation::factory()
            ->count(2)
            ->create([
                'sub_sub_location_id' => $subSubLocation->id,
            ]);

        $response = $this->getJson(
            route(
                'api.sub-sub-locations.sub-sub-sub-locations.index',
                $subSubLocation
            )
        );

        $response->assertOk()->assertSee($subSubSubLocations[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_sub_sub_location_sub_sub_sub_locations(): void
    {
        $subSubLocation = SubSubLocation::factory()->create();
        $data = SubSubSubLocation::factory()
            ->make([
                'sub_sub_location_id' => $subSubLocation->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.sub-sub-locations.sub-sub-sub-locations.store',
                $subSubLocation
            ),
            $data
        );

        $this->assertDatabaseHas('sub_sub_sub_locations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $subSubSubLocation = SubSubSubLocation::latest('id')->first();

        $this->assertEquals(
            $subSubLocation->id,
            $subSubSubLocation->sub_sub_location_id
        );
    }
}
