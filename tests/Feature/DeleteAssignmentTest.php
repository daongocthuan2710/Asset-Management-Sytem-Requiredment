<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AssetSeeder;
use Database\Seeders\AssignmentSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DeleteAssignmentTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed([
            UserSeeder::class,
            CategorySeeder::class,
            AssetSeeder::class,
            AssignmentSeeder::class,
        ]);
    }

    public function test_not_logged_user()
    {
        $id = 10; //location: DN, state: 0
        $this->json(
            "DELETE",
            "api/assignment/$id",
            [],
        )->assertStatus(401);
    }

    public function test_not_an_admin_user()
    {
        $id = 10; //location: DN, state: 0
        $response = $this->postJson('api/login', [
            'username' => 'tuanpa',
            'password' => '12345',
        ]); //admin: 0, location: DN, state: 1
        $response->assertStatus(200);
        $token = $response->getData()->token;
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $this->json(
            "DELETE",
            "api/assignment/$id",
            [],
            $header
        )->assertStatus(401);
    }

    public function test_not_same_location()
    {
        $id = 2; //location: HCM, state: 0
        $response = $this->postJson('api/login', [
            'username' => 'kienvv',
            'password' => '12345',
        ]); //admin, location: DN, state: 1
        $response->assertStatus(200);
        $token = $response->getData()->token;
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $this->json(
            "DELETE",
            "api/assignment/$id",
            [],
            $header
        )->assertStatus(401);
    }

    public function test_delete_accepted_assignment()
    {
        $id = 9; //location: DN, state: 1
        $response = $this->postJson('api/login', [
            'username' => 'kienvv',
            'password' => '12345',
        ]); //admin, location: DN, state: 1
        $response->assertStatus(200);
        $token = $response->getData()->token;
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $this->json(
            "DELETE",
            "api/assignment/$id",
            [],
            $header
        )->assertStatus(422);
    }

    public function test_success_delete_assignment()
    {
        $id = 10; //location: DN, state: 0
        $response = $this->postJson('api/login', [
            'username' => 'kienvv',
            'password' => '12345',
        ]); //admin, location: DN, state: 1
        $response->assertStatus(200);
        $token = $response->getData()->token;
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $this->json(
            "DELETE",
            "api/assignment/$id",
            [],
            $header
        )->assertStatus(200);
    }
}
