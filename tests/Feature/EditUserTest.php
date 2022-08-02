<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class EditUserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
    }

    public function test_not_logged_in_admin()
    {
        $id = 1;
        $body = [
            'date_of_birth' => '1990-02-20',
            'joined_date' => '2022-07-07',
            'gender' => false,
            'admin' => false,
        ];
        $this->json('PUT', "api/user/$id", $body)
            ->assertStatus(401);
    }

    public function test_user_is_not_an_admin()
    {
        $id = 1;
        $body = [
            'date_of_birth' => '1990-02-20',
            'joined_date' => '2022-07-07',
            'gender' => false,
            'admin' => false,
        ];
        Sanctum::actingAs(User::factory()->create([
            'admin' => false,
            'location' => 'HN',
            'staff_code' => 'SD2001',
            'base_username' => 'user',
        ]));
        $this->json('PUT', "api/user/$id", $body)
            ->assertStatus(401);
    }

    public function test_unfilled_form()
    {
        $id = 1;
        $body = [];
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'HN',
            'staff_code' => 'SD2001',
            'base_username' => 'user',
        ]));
        $this->json('PUT', "api/user/$id", $body)
            ->assertStatus(422);
    }

    public function test_fail_validated_form()
    {
        $id = 1;
        $body = [
            'date_of_birth' => '1990-02-20',
            'joined_date' => '2022-07-07',
            'gender' => false,
            'admin' => null,
        ];
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'HN',
            'staff_code' => 'SD2001',
            'base_username' => 'user',
        ]));
        $this->json('PUT', "api/user/$id", $body)
            ->assertStatus(422);
    }

    public function test_not_existed_user()
    {
        $id = 200;
        $body = [
            'date_of_birth' => '1990-02-20',
            'joined_date' => '2022-07-07', //Thursday
            'gender' => false,
            'admin' => false,
        ];
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'HN',
            'staff_code' => 'SD2001',
            'base_username' => 'user',
        ]));
        $this->json('PUT', "api/user/$id", $body)
            ->assertStatus(404);
    }

    public function test_not_same_location_user()
    {
        $id = 3; //user in HCM
        $body = [
            'date_of_birth' => '1990-02-20',
            'joined_date' => '2022-07-07',
            'gender' => false,
            'admin' => false,
        ];
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'HN',
            'staff_code' => 'SD2001',
            'base_username' => 'user',
        ]));
        $this->json('PUT', "api/user/$id", $body)
            ->assertStatus(401);
    }

    public function test_under_18_user()
    {
        $id = 1;
        $body = [
            'date_of_birth' => '2010-02-20',
            'joined_date' => '2022-07-09',
            'gender' => false,
            'admin' => false,
        ];
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'HN',
            'staff_code' => 'SD2001',
            'base_username' => 'user',
        ]));
        $this->json('PUT', "api/user/$id", $body)
            ->assertStatus(422);
    }

    public function test_join_before_DOB()
    {
        $id = 1;
        $body = [
            'date_of_birth' => '2000-02-20',
            'joined_date' => '1999-07-09',
            'gender' => false,
            'admin' => false,
        ];
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'HN',
            'staff_code' => 'SD2001',
            'base_username' => 'user',
        ]));
        $this->json('PUT', "api/user/$id", $body)
            ->assertStatus(422);
    }

    public function test_join_at_no_work_day_user()
    {
        $id = 1;
        $body = [
            'date_of_birth' => '1990-02-20',
            'joined_date' => '2022-07-09', //Saturday
            'gender' => false,
            'admin' => false,
        ];
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'HN',
            'staff_code' => 'SD2001',
            'base_username' => 'user',
        ]));
        $this->json('PUT', "api/user/$id", $body)
            ->assertStatus(422);
    }

    public function test_success_update()
    {
        $id = 1;
        $body = [
            'date_of_birth' => '1990-02-20',
            'joined_date' => '2022-07-07',
            'gender' => false,
            'admin' => false,
        ];
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'HN',
            'staff_code' => 'SD2001',
            'base_username' => 'user',
        ]));
        $this->json('PUT', "api/user/$id", $body)
            ->assertStatus(200);
    }
}
