<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SubSubSubLocation;

use App\Models\SubSubLocation;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubSubSubLocationTest extends TestCase
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
    public function it_gets_sub_sub_sub_locations_list(): void
    {
        $subSubSubLocations = SubSubSubLocation::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.sub-sub-sub-locations.index'));

        $response->assertOk()->assertSee($subSubSubLocations[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_sub_sub_sub_location(): void
    {
        $data = SubSubSubLocation::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.sub-sub-sub-locations.store'),
            $data
        );

        $this->assertDatabaseHas('sub_sub_sub_locations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_sub_sub_sub_location(): void
    {
        $subSubSubLocation = SubSubSubLocation::factory()->create();

        $subSubLocation = SubSubLocation::factory()->create();

        $data = [
            'Name' => $this->faker->name(),
            'sub_sub_location_id' => $subSubLocation->id,
        ];

        $response = $this->putJson(
            route('api.sub-sub-sub-locations.update', $subSubSubLocation),
            $data
        );

        $data['id'] = $subSubSubLocation->id;

        $this->assertDatabaseHas('sub_sub_sub_locations', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_sub_sub_sub_location(): void
    {
        $subSubSubLocation = SubSubSubLocation::factory()->create();

        $response = $this->deleteJson(
            route('api.sub-sub-sub-locations.destroy', $subSubSubLocation)
        );

        $this->assertModelMissing($subSubSubLocation);

        $response->assertNoContent();
    }
}
