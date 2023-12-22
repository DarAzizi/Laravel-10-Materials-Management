<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubCategorySubSubCategoriesTest extends TestCase
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
    public function it_gets_sub_category_sub_sub_categories(): void
    {
        $subCategory = SubCategory::factory()->create();
        $subSubCategories = SubSubCategory::factory()
            ->count(2)
            ->create([
                'sub_category_id' => $subCategory->id,
            ]);

        $response = $this->getJson(
            route('api.sub-categories.sub-sub-categories.index', $subCategory)
        );

        $response->assertOk()->assertSee($subSubCategories[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_sub_category_sub_sub_categories(): void
    {
        $subCategory = SubCategory::factory()->create();
        $data = SubSubCategory::factory()
            ->make([
                'sub_category_id' => $subCategory->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.sub-categories.sub-sub-categories.store', $subCategory),
            $data
        );

        $this->assertDatabaseHas('sub_sub_categories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $subSubCategory = SubSubCategory::latest('id')->first();

        $this->assertEquals($subCategory->id, $subSubCategory->sub_category_id);
    }
}
