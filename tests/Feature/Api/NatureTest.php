<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Nature;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NatureTest extends TestCase
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
    public function it_gets_natures_list(): void
    {
        $natures = Nature::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.natures.index'));

        $response->assertOk()->assertSee($natures[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_nature(): void
    {
        $data = Nature::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.natures.store'), $data);

        $this->assertDatabaseHas('natures', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_nature(): void
    {
        $nature = Nature::factory()->create();

        $data = [
            'Nature' => 'Consumable',
        ];

        $response = $this->putJson(route('api.natures.update', $nature), $data);

        $data['id'] = $nature->id;

        $this->assertDatabaseHas('natures', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_nature(): void
    {
        $nature = Nature::factory()->create();

        $response = $this->deleteJson(route('api.natures.destroy', $nature));

        $this->assertModelMissing($nature);

        $response->assertNoContent();
    }
}
