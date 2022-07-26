<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ManageUserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
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
        $this->json('PUT', "api/user/$id", $body)
            ->assertStatus(404);
    }

    public function test_join_at_no_work_day_user()
    {
        $id = 2;
        $body = [
            'date_of_birth' => '1990-02-20',
            'joined_date' => '2022-07-09', //Saturday
            'gender' => false,
            'admin' => false,
        ];
        $this->json('PUT', "api/user/$id", $body)
            ->assertStatus(422);
    }

    public function test_under_18_user()
    {
        $id = 2;
        $body = [
            'date_of_birth' => '2010-02-20',
            'joined_date' => '2022-07-09',
            'gender' => false,
            'admin' => false,
        ];
        $this->json('PUT', "api/user/$id", $body)
            ->assertStatus(422);
    }

    public function test_join_before_DOB()
    {
        $id = 2;
        $body = [
            'date_of_birth' => '2010-02-20',
            'joined_date' => '2009-07-09',
            'gender' => false,
            'admin' => false,
        ];
        $this->json('PUT', "api/user/$id", $body)
            ->assertStatus(422);
    }

    public function test_unfilled_form()
    {
        $id = 2;
        $body = [
            'date_of_birth' => '2010-02-20',
            'joined_date' => '2009-07-09',
            'gender' => false,
        ];
        $this->json('PUT', "api/user/$id", $body)
            ->assertStatus(422);
    }

    public function test_success_update()
    {
        $id = 2;
        $body = [
            'date_of_birth' => '1990-02-20',
            'joined_date' => '2022-07-07',
            'gender' => false,
            'admin' => false,
        ];
        $this->json('PUT', "api/user/$id", $body)
            ->assertStatus(200);
    }
}
