<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Contractor;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractorControllerTest extends TestCase
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
    public function it_displays_index_view_with_contractors(): void
    {
        $contractors = Contractor::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('contractors.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.contractors.index')
            ->assertViewHas('contractors');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_contractor(): void
    {
        $response = $this->get(route('contractors.create'));

        $response->assertOk()->assertViewIs('app.contractors.create');
    }

    /**
     * @test
     */
    public function it_stores_the_contractor(): void
    {
        $data = Contractor::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('contractors.store'), $data);

        $this->assertDatabaseHas('contractors', $data);

        $contractor = Contractor::latest('id')->first();

        $response->assertRedirect(route('contractors.edit', $contractor));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_contractor(): void
    {
        $contractor = Contractor::factory()->create();

        $response = $this->get(route('contractors.show', $contractor));

        $response
            ->assertOk()
            ->assertViewIs('app.contractors.show')
            ->assertViewHas('contractor');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_contractor(): void
    {
        $contractor = Contractor::factory()->create();

        $response = $this->get(route('contractors.edit', $contractor));

        $response
            ->assertOk()
            ->assertViewIs('app.contractors.edit')
            ->assertViewHas('contractor');
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

        $response = $this->put(route('contractors.update', $contractor), $data);

        $data['id'] = $contractor->id;

        $this->assertDatabaseHas('contractors', $data);

        $response->assertRedirect(route('contractors.edit', $contractor));
    }

    /**
     * @test
     */
    public function it_deletes_the_contractor(): void
    {
        $contractor = Contractor::factory()->create();

        $response = $this->delete(route('contractors.destroy', $contractor));

        $response->assertRedirect(route('contractors.index'));

        $this->assertModelMissing($contractor);
    }
}
