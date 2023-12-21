<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Contractor;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractorTest extends TestCase
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
    public function it_gets_contractors_list(): void
    {
        $contractors = Contractor::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.contractors.index'));

        $response->assertOk()->assertSee($contractors[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_contractor(): void
    {
        $data = Contractor::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.contractors.store'), $data);

        $this->assertDatabaseHas('contractors', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_contractor(): void
    {
        $contractor = Contractor::factory()->create();

        $data = [
            'Name' => $this->faker->name(),
            'Description' => $this->faker->sentence(15),
        ];

        $response = $this->putJson(
            route('api.contractors.update', $contractor),
            $data
        );

        $data['id'] = $contractor->id;

        $this->assertDatabaseHas('contractors', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_contractor(): void
    {
        $contractor = Contractor::factory()->create();

        $response = $this->deleteJson(
            route('api.contractors.destroy', $contractor)
        );

        $this->assertModelMissing($contractor);

        $response->assertNoContent();
    }
}
