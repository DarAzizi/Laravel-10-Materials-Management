<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Nature;
use App\Models\Material;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NatureMaterialsTest extends TestCase
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
    public function it_gets_nature_materials(): void
    {
        $nature = Nature::factory()->create();
        $materials = Material::factory()
            ->count(2)
            ->create([
                'nature_id' => $nature->id,
            ]);

        $response = $this->getJson(
            route('api.natures.materials.index', $nature)
        );

        $response->assertOk()->assertSee($materials[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_nature_materials(): void
    {
        $nature = Nature::factory()->create();
        $data = Material::factory()
            ->make([
                'nature_id' => $nature->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.natures.materials.store', $nature),
            $data
        );

        $this->assertDatabaseHas('materials', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $material = Material::latest('id')->first();

        $this->assertEquals($nature->id, $material->nature_id);
    }
}
