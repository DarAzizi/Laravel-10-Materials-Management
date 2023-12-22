<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SubSubCategory;

use App\Models\SubCategory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubSubCategoryTest extends TestCase
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
    public function it_gets_sub_sub_categories_list(): void
    {
        $subSubCategories = SubSubCategory::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.sub-sub-categories.index'));

        $response->assertOk()->assertSee($subSubCategories[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_sub_sub_category(): void
    {
        $data = SubSubCategory::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.sub-sub-categories.store'),
            $data
        );

        $this->assertDatabaseHas('sub_sub_categories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.sub-sub-categories.update', $subSubCategory),
            $data
        );

        $data['id'] = $subSubCategory->id;

        $this->assertDatabaseHas('sub_sub_categories', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_sub_sub_category(): void
    {
        $subSubCategory = SubSubCategory::factory()->create();

        $response = $this->deleteJson(
            route('api.sub-sub-categories.destroy', $subSubCategory)
        );

        $this->assertModelMissing($subSubCategory);

        $response->assertNoContent();
    }
}
