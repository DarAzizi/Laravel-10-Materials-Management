<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Warehouse;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserWarehousesTest extends TestCase
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
    public function it_gets_user_warehouses(): void
    {
        $user = User::factory()->create();
        $warehouses = Warehouse::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.warehouses.index', $user));

        $response->assertOk()->assertSee($warehouses[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_warehouses(): void
    {
        $user = User::factory()->create();
        $data = Warehouse::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.warehouses.store', $user),
            $data
        );

        $this->assertDatabaseHas('warehouses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $warehouse = Warehouse::latest('id')->first();

        $this->assertEquals($user->id, $warehouse->user_id);
    }
}
