<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\SubSubLocation;

use App\Models\SubLocation;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubSubLocationControllerTest extends TestCase
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
    public function it_displays_index_view_with_sub_sub_locations(): void
    {
        $subSubLocations = SubSubLocation::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('sub-sub-locations.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.sub_sub_locations.index')
            ->assertViewHas('subSubLocations');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_sub_sub_location(): void
    {
        $response = $this->get(route('sub-sub-locations.create'));

        $response->assertOk()->assertViewIs('app.sub_sub_locations.create');
    }

    /**
     * @test
     */
    public function it_stores_the_sub_sub_location(): void
    {
        $data = SubSubLocation::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('sub-sub-locations.store'), $data);

        $this->assertDatabaseHas('sub_sub_locations', $data);

        $subSubLocation = SubSubLocation::latest('id')->first();

        $response->assertRedirect(
            route('sub-sub-locations.edit', $subSubLocation)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_sub_sub_location(): void
    {
        $subSubLocation = SubSubLocation::factory()->create();

        $response = $this->get(
            route('sub-sub-locations.show', $subSubLocation)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.sub_sub_locations.show')
            ->assertViewHas('subSubLocation');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_sub_sub_location(): void
    {
        $subSubLocation = SubSubLocation::factory()->create();

        $response = $this->get(
            route('sub-sub-locations.edit', $subSubLocation)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.sub_sub_locations.edit')
            ->assertViewHas('subSubLocation');
    }

    /**
     * @test
     */
    public function it_updates_the_sub_sub_location(): void
    {
        $subSubLocation = SubSubLocation::factory()->create();

        $subLocation = SubLocation::factory()->create();

        $data = [
            'Name' => $this->faker->name(),
            'sub_location_id' => $subLocation->id,
        ];

        $response = $this->put(
            route('sub-sub-locations.update', $subSubLocation),
            $data
        );

        $data['id'] = $subSubLocation->id;

        $this->assertDatabaseHas('sub_sub_locations', $data);

        $response->assertRedirect(
            route('sub-sub-locations.edit', $subSubLocation)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_sub_sub_location(): void
    {
        $subSubLocation = SubSubLocation::factory()->create();

        $response = $this->delete(
            route('sub-sub-locations.destroy', $subSubLocation)
        );

        $response->assertRedirect(route('sub-sub-locations.index'));

        $this->assertModelMissing($subSubLocation);
    }
}
