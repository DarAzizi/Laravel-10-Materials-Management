<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\SubSubSubLocation;

use App\Models\SubSubLocation;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubSubSubLocationControllerTest extends TestCase
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
    public function it_displays_index_view_with_sub_sub_sub_locations(): void
    {
        $subSubSubLocations = SubSubSubLocation::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('sub-sub-sub-locations.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.sub_sub_sub_locations.index')
            ->assertViewHas('subSubSubLocations');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_sub_sub_sub_location(): void
    {
        $response = $this->get(route('sub-sub-sub-locations.create'));

        $response->assertOk()->assertViewIs('app.sub_sub_sub_locations.create');
    }

    /**
     * @test
     */
    public function it_stores_the_sub_sub_sub_location(): void
    {
        $data = SubSubSubLocation::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('sub-sub-sub-locations.store'), $data);

        $this->assertDatabaseHas('sub_sub_sub_locations', $data);

        $subSubSubLocation = SubSubSubLocation::latest('id')->first();

        $response->assertRedirect(
            route('sub-sub-sub-locations.edit', $subSubSubLocation)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_sub_sub_sub_location(): void
    {
        $subSubSubLocation = SubSubSubLocation::factory()->create();

        $response = $this->get(
            route('sub-sub-sub-locations.show', $subSubSubLocation)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.sub_sub_sub_locations.show')
            ->assertViewHas('subSubSubLocation');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_sub_sub_sub_location(): void
    {
        $subSubSubLocation = SubSubSubLocation::factory()->create();

        $response = $this->get(
            route('sub-sub-sub-locations.edit', $subSubSubLocation)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.sub_sub_sub_locations.edit')
            ->assertViewHas('subSubSubLocation');
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

        $response = $this->put(
            route('sub-sub-sub-locations.update', $subSubSubLocation),
            $data
        );

        $data['id'] = $subSubSubLocation->id;

        $this->assertDatabaseHas('sub_sub_sub_locations', $data);

        $response->assertRedirect(
            route('sub-sub-sub-locations.edit', $subSubSubLocation)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_sub_sub_sub_location(): void
    {
        $subSubSubLocation = SubSubSubLocation::factory()->create();

        $response = $this->delete(
            route('sub-sub-sub-locations.destroy', $subSubSubLocation)
        );

        $response->assertRedirect(route('sub-sub-sub-locations.index'));

        $this->assertModelMissing($subSubSubLocation);
    }
}
