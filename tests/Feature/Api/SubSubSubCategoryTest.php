<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SubSubSubCategory;

use App\Models\SubSubCategory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubSubSubCategoryTest extends TestCase
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
    public function it_gets_sub_sub_sub_categories_list(): void
    {
        $subSubSubCategories = SubSubSubCategory::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.sub-sub-sub-categories.index'));

        $response->assertOk()->assertSee($subSubSubCategories[0]->Name);
    }

    /**
     * @test
     */
    public function it_stores_the_sub_sub_sub_category(): void
    {
        $data = SubSubSubCategory::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.sub-sub-sub-categories.store'),
            $data
        );

        $this->assertDatabaseHas('sub_sub_sub_categories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.sub-sub-sub-categories.update', $subSubSubCategory),
            $data
        );

        $data['id'] = $subSubSubCategory->id;

        $this->assertDatabaseHas('sub_sub_sub_categories', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_sub_sub_sub_category(): void
    {
        $subSubSubCategory = SubSubSubCategory::factory()->create();

        $response = $this->deleteJson(
            route('api.sub-sub-sub-categories.destroy', $subSubSubCategory)
        );

        $this->assertModelMissing($subSubSubCategory);

        $response->assertNoContent();
    }
}
