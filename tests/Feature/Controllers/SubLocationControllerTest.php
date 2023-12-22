<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\SubLocation;

use App\Models\Location;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubLocationControllerTest extends TestCase
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
    public function it_displays_index_view_with_sub_locations(): void
    {
        $subLocations = SubLocation::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('sub-locations.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.sub_locations.index')
            ->assertViewHas('subLocations');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_sub_location(): void
    {
        $response = $this->get(route('sub-locations.create'));

        $response->assertOk()->assertViewIs('app.sub_locations.create');
    }

    /**
     * @test
     */
    public function it_stores_the_sub_location(): void
    {
        $data = SubLocation::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('sub-locations.store'), $data);

        $this->assertDatabaseHas('sub_locations', $data);

        $subLocation = SubLocation::latest('id')->first();

        $response->assertRedirect(route('sub-locations.edit', $subLocation));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_sub_location(): void
    {
        $subLocation = SubLocation::factory()->create();

        $response = $this->get(route('sub-locations.show', $subLocation));

        $response
            ->assertOk()
            ->assertViewIs('app.sub_locations.show')
            ->assertViewHas('subLocation');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_sub_location(): void
    {
        $subLocation = SubLocation::factory()->create();

        $response = $this->get(route('sub-locations.edit', $subLocation));

        $response
            ->assertOk()
            ->assertViewIs('app.sub_locations.edit')
            ->assertViewHas('subLocation');
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

        $response = $this->put(
            route('sub-locations.update', $subLocation),
            $data
        );

        $data['id'] = $subLocation->id;

        $this->assertDatabaseHas('sub_locations', $data);

        $response->assertRedirect(route('sub-locations.edit', $subLocation));
    }

    /**
     * @test
     */
    public function it_deletes_the_sub_location(): void
    {
        $subLocation = SubLocation::factory()->create();

        $response = $this->delete(route('sub-locations.destroy', $subLocation));

        $response->assertRedirect(route('sub-locations.index'));

        $this->assertModelMissing($subLocation);
    }
}
