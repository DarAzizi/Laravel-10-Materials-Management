<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Nature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NatureControllerTest extends TestCase
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
    public function it_displays_index_view_with_natures(): void
    {
        $natures = Nature::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('natures.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.natures.index')
            ->assertViewHas('natures');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_nature(): void
    {
        $response = $this->get(route('natures.create'));

        $response->assertOk()->assertViewIs('app.natures.create');
    }

    /**
     * @test
     */
    public function it_stores_the_nature(): void
    {
        $data = Nature::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('natures.store'), $data);

        $this->assertDatabaseHas('natures', $data);

        $nature = Nature::latest('id')->first();

        $response->assertRedirect(route('natures.edit', $nature));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_nature(): void
    {
        $nature = Nature::factory()->create();

        $response = $this->get(route('natures.show', $nature));

        $response
            ->assertOk()
            ->assertViewIs('app.natures.show')
            ->assertViewHas('nature');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_nature(): void
    {
        $nature = Nature::factory()->create();

        $response = $this->get(route('natures.edit', $nature));

        $response
            ->assertOk()
            ->assertViewIs('app.natures.edit')
            ->assertViewHas('nature');
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

        $response = $this->put(route('natures.update', $nature), $data);

        $data['id'] = $nature->id;

        $this->assertDatabaseHas('natures', $data);

        $response->assertRedirect(route('natures.edit', $nature));
    }

    /**
     * @test
     */
    public function it_deletes_the_nature(): void
    {
        $nature = Nature::factory()->create();

        $response = $this->delete(route('natures.destroy', $nature));

        $response->assertRedirect(route('natures.index'));

        $this->assertModelMissing($nature);
    }
}
