<?php

namespace Tests\Feature\Api;

use App\Models\Staff;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StaffTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = Staff::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_all_staff_list(): void
    {
        $allStaff = Staff::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-staff.index'));

        $response->assertOk()->assertSee($allStaff[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_staff(): void
    {
        $data = Staff::factory()
            ->make()
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(route('api.all-staff.store'), $data);

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['two_factor_confirmed_at']);
        unset($data['current_team_id']);
        unset($data['profile_photo_path']);

        $this->assertDatabaseHas('staff', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_staff(): void
    {
        $staff = Staff::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'gender' => \Arr::random(['male', 'female', 'other']),
            'mobile' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique->email(),
        ];

        $data['password'] = \Str::random('8');

        $response = $this->putJson(
            route('api.all-staff.update', $staff),
            $data
        );

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['two_factor_confirmed_at']);
        unset($data['current_team_id']);
        unset($data['profile_photo_path']);

        $data['id'] = $staff->id;

        $this->assertDatabaseHas('staff', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_staff(): void
    {
        $staff = Staff::factory()->create();

        $response = $this->deleteJson(route('api.all-staff.destroy', $staff));

        $this->assertModelMissing($staff);

        $response->assertNoContent();
    }
}
