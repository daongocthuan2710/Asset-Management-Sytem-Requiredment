<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Tests\TestCase;

class ManageUserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_staff_fail_to_manage_user()
    {
        $response = $this->postJson('api/login', [
            'username' => 'dungva',
            'password' => '12345',
        ]);
        $response->assertStatus(200);
        $token = $response->getData()->token;

        $viewUser = $this->getJson('api/manageUser', [
            'Authorization' => "Bearer $token"
        ]);
        $viewUser->assertStatus(401);
    }

    public function test_admin_manage_user_successfully()
    {
        $response = $this->postJson('api/login', [
            "username" => "bichvht",
            "password" => "12345"
        ]);
        $response->assertStatus(200);
        $token = $response->getData()->token;

        $viewUser = $this->getJson('api/manageUser', [
            'Authorization' => "Bearer $token"
        ]);
        $viewUser->assertStatus(200);
    }
    public function test_admin_view_user_in_the_same_location()
    {
        $response = $this->postJson('api/login', [
            "username" => "tuandc",
            "password" => "12345"
        ]);
        $response->assertStatus(200);
        $token = $response->getData()->token;

        $viewUser = $this->getJson('api/manageUser', [
            'Authorization' => "Bearer $token"
        ]);
        $viewUser->assertStatus(200)->assertJsonFragment([
            "location" => "HCM"
        ]);
    }
}
