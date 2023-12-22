<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Material;
use App\Models\JetPosition;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JetPositionMaterialsTest extends TestCase
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
    public function it_gets_jet_position_materials(): void
    {
        $jetPosition = JetPosition::factory()->create();
        $materials = Material::factory()
            ->count(2)
            ->create([
                'jet_position_id' => $jetPosition->id,
            ]);

        $response = $this->getJson(
            route('api.jet-positions.materials.index', $jetPosition)
        );

        $response->assertOk()->assertSee($materials[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_jet_position_materials(): void
    {
        $jetPosition = JetPosition::factory()->create();
        $data = Material::factory()
            ->make([
                'jet_position_id' => $jetPosition->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.jet-positions.materials.store', $jetPosition),
            $data
        );

        $this->assertDatabaseHas('materials', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $material = Material::latest('id')->first();

        $this->assertEquals($jetPosition->id, $material->jet_position_id);
    }
}
