<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\SubSubSubCategory;

use App\Models\SubSubCategory;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubSubSubCategoryControllerTest extends TestCase
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
    public function it_displays_index_view_with_sub_sub_sub_categories(): void
    {
        $subSubSubCategories = SubSubSubCategory::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('sub-sub-sub-categories.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.sub_sub_sub_categories.index')
            ->assertViewHas('subSubSubCategories');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_sub_sub_sub_category(): void
    {
        $response = $this->get(route('sub-sub-sub-categories.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.sub_sub_sub_categories.create');
    }

    /**
     * @test
     */
    public function it_stores_the_sub_sub_sub_category(): void
    {
        $data = SubSubSubCategory::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('sub-sub-sub-categories.store'), $data);

        $this->assertDatabaseHas('sub_sub_sub_categories', $data);

        $subSubSubCategory = SubSubSubCategory::latest('id')->first();

        $response->assertRedirect(
            route('sub-sub-sub-categories.edit', $subSubSubCategory)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_sub_sub_sub_category(): void
    {
        $subSubSubCategory = SubSubSubCategory::factory()->create();

        $response = $this->get(
            route('sub-sub-sub-categories.show', $subSubSubCategory)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.sub_sub_sub_categories.show')
            ->assertViewHas('subSubSubCategory');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_sub_sub_sub_category(): void
    {
        $subSubSubCategory = SubSubSubCategory::factory()->create();

        $response = $this->get(
            route('sub-sub-sub-categories.edit', $subSubSubCategory)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.sub_sub_sub_categories.edit')
            ->assertViewHas('subSubSubCategory');
    }

    /**
     * @test
     */
    public function it_updates_the_sub_sub_sub_category(): void
    {
        $subSubSubCategory = SubSubSubCategory::factory()->create();

        $subSubCategory = SubSubCategory::factory()->create();

        $data = [
            'Name' => $this->faker->name(),
            'sub_sub_category_id' => $subSubCategory->id,
        ];

        $response = $this->put(
            route('sub-sub-sub-categories.update', $subSubSubCategory),
            $data
        );

        $data['id'] = $subSubSubCategory->id;

        $this->assertDatabaseHas('sub_sub_sub_categories', $data);

        $response->assertRedirect(
            route('sub-sub-sub-categories.edit', $subSubSubCategory)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_sub_sub_sub_category(): void
    {
        $subSubSubCategory = SubSubSubCategory::factory()->create();

        $response = $this->delete(
            route('sub-sub-sub-categories.destroy', $subSubSubCategory)
        );

        $response->assertRedirect(route('sub-sub-sub-categories.index'));

        $this->assertModelMissing($subSubSubCategory);
    }
}
