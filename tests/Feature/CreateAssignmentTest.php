<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AssetSeeder;
use Database\Seeders\AssignmentSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\UserSeeder;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateAssignmentTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
        $this->seed(CategorySeeder::class);
        $this->seed(AssetSeeder::class);
        $this->seed(AssignmentSeeder::class);
    }

    public function test_is_not_admin()
    {
        Sanctum::actingAs(User::factory()->create([
            'admin' => false,
            'location' => 'HN',
            'staff_code' => 'SD2001',
        ]));
        $body = [
            "staff_id" => 10,
            "asset_id" => 20,
            "assigned_date" => "2022-08-08",
            'note' => "test"
        ];
        $this->json('POST', 'api/assignment', $body)->assertStatus(401);
    }
    public function test_create_success()
    {
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'HN',
            'staff_code' => 'SD2001',
        ]));
        $body = [
            "staff_id" => 10,
            "asset_id" => 20,
            "assigned_date" => "2022-08-08",
            'note' => "test"
        ];
        $this->json('POST', 'api/assignment', $body)->assertStatus(201);
    }
    public function test_staff_not_exits()
    {
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'HN',
            'staff_code' => 'SD2001',
        ]));
        $body = [
            "staff_id" => 100,
            "asset_id" => 20,
            "assigned_date" => "2022-08-08",
            'note' => "test"
        ];
        $this->json('POST', 'api/assignment', $body)->assertStatus(400);
    }
    public function test_asset_not_exits()
    {
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'HN',
            'staff_code' => 'SD2001',
        ]));
        $body = [
            "staff_id" => 10,
            "asset_id" => 200,
            "assigned_date" => "2022-08-08",
            'note' => "test"
        ];
        $this->json('POST', 'api/assignment', $body)->assertStatus(400);
    }
    public function test_assigned_date_not_exits()
    {
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'HN',
            'staff_code' => 'SD2001',
        ]));
        $body = [
            "staff_id" => 10,
            "asset_id" => 200,
            "assigned_date" => "",
            'note' => "test"
        ];
        $this->json('POST', 'api/assignment', $body)->assertStatus(400);
    }
    public function test_note_not_exits()
    {
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'HN',
            'staff_code' => 'SD2001',
        ]));
        $body = [
            "staff_id" => 10,
            "asset_id" => 200,
            "assigned_date" => "2022-08-08",
            'note' => ""
        ];
        $this->json('POST', 'api/assignment', $body)->assertStatus(400);
    }
}