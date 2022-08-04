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

class ResponseAssignmentTest extends TestCase
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

    public function test_unlogged_user()
    {
        $id = 32; //staff_id: 13, state: 0
        $body = [
            'response' => true,
        ];
        $this->json('POST', "api/response-assignment/$id", $body)
            ->assertStatus(401);
    }

    public function test_disabled_user()
    {
        $id = 32; //staff_id: 13, state: 0
        $body = [
            'response' => true,
        ];
        Sanctum::actingAs(User::findOrFail(3)); //state: -1
        $this->json('POST', "api/response-assignment/$id", $body)
            ->assertStatus(401);
    }

    public function test_not_existed_assignment()
    {
        $id = 20000; //not existed
        $body = [
            'response' => true,
        ];
        Sanctum::actingAs(User::findOrFail(13)); //state: 1
        $this->json('POST', "api/response-assignment/$id", $body)
            ->assertStatus(404);
    }

    public function test_response_to_others_assignment()
    {
        $id = 36; //staff_id: 46, state: 0
        $body = [
            'response' => true,
        ];
        Sanctum::actingAs(User::findOrFail(13)); //state: 1
        $this->json('POST', "api/response-assignment/$id", $body)
            ->assertStatus(422);
    }

    public function test_response_to_respond_assignment()
    {
        $id = 35; //staff_id: 42, state: 1
        $body = [
            'response' => true,
        ];
        Sanctum::actingAs(User::findOrFail(42)); //state: 1
        $this->json('POST', "api/response-assignment/$id", $body)
            ->assertStatus(422);
    }

    public function test_success_response()
    {
        $id = 32; //staff_id: 13, state: 0
        $body = [
            'response' => true,
        ];
        Sanctum::actingAs(User::findOrFail(13)); //state: 1
        $this->json('POST', "api/response-assignment/$id", $body)
            ->assertStatus(200);
    }
}
