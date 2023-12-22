<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\SubSubCategory;

use App\Models\SubCategory;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubSubCategoryControllerTest extends TestCase
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
    public function it_displays_index_view_with_sub_sub_categories(): void
    {
        $subSubCategories = SubSubCategory::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('sub-sub-categories.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.sub_sub_categories.index')
            ->assertViewHas('subSubCategories');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_sub_sub_category(): void
    {
        $response = $this->get(route('sub-sub-categories.create'));

        $response->assertOk()->assertViewIs('app.sub_sub_categories.create');
    }

    /**
     * @test
     */
    public function it_stores_the_sub_sub_category(): void
    {
        $data = SubSubCategory::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('sub-sub-categories.store'), $data);

        $this->assertDatabaseHas('sub_sub_categories', $data);

        $subSubCategory = SubSubCategory::latest('id')->first();

        $response->assertRedirect(
            route('sub-sub-categories.edit', $subSubCategory)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_sub_sub_category(): void
    {
        $subSubCategory = SubSubCategory::factory()->create();

        $response = $this->get(
            route('sub-sub-categories.show', $subSubCategory)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.sub_sub_categories.show')
            ->assertViewHas('subSubCategory');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_sub_sub_category(): void
    {
        $subSubCategory = SubSubCategory::factory()->create();

        $response = $this->get(
            route('sub-sub-categories.edit', $subSubCategory)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.sub_sub_categories.edit')
            ->assertViewHas('subSubCategory');
    }

    /**
     * @test
     */
    public function it_updates_the_sub_sub_category(): void
    {
        $subSubCategory = SubSubCategory::factory()->create();

        $subCategory = SubCategory::factory()->create();

        $data = [
            'Name' => $this->faker->name(),
            'sub_category_id' => $subCategory->id,
        ];

        $response = $this->put(
            route('sub-sub-categories.update', $subSubCategory),
            $data
        );

        $data['id'] = $subSubCategory->id;

        $this->assertDatabaseHas('sub_sub_categories', $data);

        $response->assertRedirect(
            route('sub-sub-categories.edit', $subSubCategory)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_sub_sub_category(): void
    {
        $subSubCategory = SubSubCategory::factory()->create();

        $response = $this->delete(
            route('sub-sub-categories.destroy', $subSubCategory)
        );

        $response->assertRedirect(route('sub-sub-categories.index'));

        $this->assertModelMissing($subSubCategory);
    }
}
