<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SubCategory;

use App\Models\Category;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubCategoryTest extends TestCase
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
    public function it_gets_sub_categories_list(): void
    {
        $subCategories = SubCategory::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.sub-categories.index'));

        $response->assertOk()->assertSee($subCategories[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_sub_category(): void
    {
        $data = SubCategory::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.sub-categories.store'), $data);

        $this->assertDatabaseHas('sub_categories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.sub-categories.update', $subCategory),
            $data
        );

        $data['id'] = $subCategory->id;

        $this->assertDatabaseHas('sub_categories', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_sub_category(): void
    {
        $subCategory = SubCategory::factory()->create();

        $response = $this->deleteJson(
            route('api.sub-categories.destroy', $subCategory)
        );

        $this->assertModelMissing($subCategory);

        $response->assertNoContent();
    }
}
