<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\SubCategory;

use App\Models\Category;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubCategoryControllerTest extends TestCase
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
    public function it_displays_index_view_with_sub_categories(): void
    {
        $subCategories = SubCategory::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('sub-categories.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.sub_categories.index')
            ->assertViewHas('subCategories');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_sub_category(): void
    {
        $response = $this->get(route('sub-categories.create'));

        $response->assertOk()->assertViewIs('app.sub_categories.create');
    }

    /**
     * @test
     */
    public function it_stores_the_sub_category(): void
    {
        $data = SubCategory::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('sub-categories.store'), $data);

        $this->assertDatabaseHas('sub_categories', $data);

        $subCategory = SubCategory::latest('id')->first();

        $response->assertRedirect(route('sub-categories.edit', $subCategory));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_sub_category(): void
    {
        $subCategory = SubCategory::factory()->create();

        $response = $this->get(route('sub-categories.show', $subCategory));

        $response
            ->assertOk()
            ->assertViewIs('app.sub_categories.show')
            ->assertViewHas('subCategory');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_sub_category(): void
    {
        $subCategory = SubCategory::factory()->create();

        $response = $this->get(route('sub-categories.edit', $subCategory));

        $response
            ->assertOk()
            ->assertViewIs('app.sub_categories.edit')
            ->assertViewHas('subCategory');
    }

    /**
     * @test
     */
    public function it_updates_the_sub_category(): void
    {
        $subCategory = SubCategory::factory()->create();

        $category = Category::factory()->create();

        $data = [
            'Name' => $this->faker->name(),
            'category_id' => $category->id,
        ];

        $response = $this->put(
            route('sub-categories.update', $subCategory),
            $data
        );

        $data['id'] = $subCategory->id;

        $this->assertDatabaseHas('sub_categories', $data);

        $response->assertRedirect(route('sub-categories.edit', $subCategory));
    }

    /**
     * @test
     */
    public function it_deletes_the_sub_category(): void
    {
        $subCategory = SubCategory::factory()->create();

        $response = $this->delete(
            route('sub-categories.destroy', $subCategory)
        );

        $response->assertRedirect(route('sub-categories.index'));

        $this->assertModelMissing($subCategory);
    }
}
