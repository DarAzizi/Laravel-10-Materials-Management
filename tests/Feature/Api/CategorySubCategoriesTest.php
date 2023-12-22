<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategorySubCategoriesTest extends TestCase
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
    public function it_gets_category_sub_categories(): void
    {
        $category = Category::factory()->create();
        $subCategories = SubCategory::factory()
            ->count(2)
            ->create([
                'category_id' => $category->id,
            ]);

        $response = $this->getJson(
            route('api.categories.sub-categories.index', $category)
        );

        $response->assertOk()->assertSee($subCategories[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_category_sub_categories(): void
    {
        $category = Category::factory()->create();
        $data = SubCategory::factory()
            ->make([
                'category_id' => $category->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.categories.sub-categories.store', $category),
            $data
        );

        $this->assertDatabaseHas('sub_categories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $subCategory = SubCategory::latest('id')->first();

        $this->assertEquals($category->id, $subCategory->category_id);
    }
}
