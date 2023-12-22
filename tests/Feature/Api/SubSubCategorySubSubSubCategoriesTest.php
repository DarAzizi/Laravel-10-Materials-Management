<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SubSubCategory;
use App\Models\SubSubSubCategory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubSubCategorySubSubSubCategoriesTest extends TestCase
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
    public function it_gets_sub_sub_category_sub_sub_sub_categories(): void
    {
        $subSubCategory = SubSubCategory::factory()->create();
        $subSubSubCategories = SubSubSubCategory::factory()
            ->count(2)
            ->create([
                'sub_sub_category_id' => $subSubCategory->id,
            ]);

        $response = $this->getJson(
            route(
                'api.sub-sub-categories.sub-sub-sub-categories.index',
                $subSubCategory
            )
        );

        $response->assertOk()->assertSee($subSubSubCategories[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_sub_sub_category_sub_sub_sub_categories(): void
    {
        $subSubCategory = SubSubCategory::factory()->create();
        $data = SubSubSubCategory::factory()
            ->make([
                'sub_sub_category_id' => $subSubCategory->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.sub-sub-categories.sub-sub-sub-categories.store',
                $subSubCategory
            ),
            $data
        );

        $this->assertDatabaseHas('sub_sub_sub_categories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $subSubSubCategory = SubSubSubCategory::latest('id')->first();

        $this->assertEquals(
            $subSubCategory->id,
            $subSubSubCategory->sub_sub_category_id
        );
    }
}
