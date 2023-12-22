<?php

namespace Tests\Feature\Api;

use App\Models\Staff;
use App\Models\Warehouse;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StaffWarehousesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = Staff::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_staff_warehouses(): void
    {
        $staff = Staff::factory()->create();
        $warehouses = Warehouse::factory()
            ->count(2)
            ->create([
                'staff_id' => $staff->id,
            ]);

        $response = $this->getJson(
            route('api.all-staff.warehouses.index', $staff)
        );

        $response->assertOk()->assertSee($warehouses[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_staff_warehouses(): void
    {
        $staff = Staff::factory()->create();
        $data = Warehouse::factory()
            ->make([
                'staff_id' => $staff->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.all-staff.warehouses.store', $staff),
            $data
        );

        $this->assertDatabaseHas('warehouses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $warehouse = Warehouse::latest('id')->first();

        $this->assertEquals($staff->id, $warehouse->staff_id);
    }
}
