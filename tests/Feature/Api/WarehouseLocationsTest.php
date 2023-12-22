<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Location;
use App\Models\Warehouse;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WarehouseLocationsTest extends TestCase
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
    public function it_gets_warehouse_locations(): void
    {
        $warehouse = Warehouse::factory()->create();
        $locations = Location::factory()
            ->count(2)
            ->create([
                'warehouse_id' => $warehouse->id,
            ]);

        $response = $this->getJson(
            route('api.warehouses.locations.index', $warehouse)
        );

        $response->assertOk()->assertSee($locations[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_warehouse_locations(): void
    {
        $warehouse = Warehouse::factory()->create();
        $data = Location::factory()
            ->make([
                'warehouse_id' => $warehouse->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.warehouses.locations.store', $warehouse),
            $data
        );

        unset($data['warehouse_id']);

        $this->assertDatabaseHas('locations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $location = Location::latest('id')->first();

        $this->assertEquals($warehouse->id, $location->warehouse_id);
    }
}
