<?php

namespace Tests\Feature;

use Tests\TestCase;
use Database\Seeders\CategorySeeder;
use Database\Seeders\AssetSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AssignmentSeeder;

class ManageAssignmentTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed(CategorySeeder::class);
        $this->seed(AssetSeeder::class);
        $this->seed(UserSeeder::class);
        $this->seed(AssignmentSeeder::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_staff_could_not_manage_assginment()
    {
        $santumUser = $this->getSanctum("tuandd", "12345");

        $viewAsset = $this->getJson('api/assignment', [
            'Authorization' => "Bearer $santumUser->token"
        ]);
        $viewAsset->assertStatus(401);
    }

    public function test_admin_can_manage_assignment_in_the_same_location_only()
    {
        $santumUser = $this->getSanctum("quytc", "12345");

        $viewAsset = $this->getJson('api/assignment', [
            'Authorization' => "Bearer $santumUser->token"
        ]);
        $viewAsset->assertStatus(200)->assertJsonFragment([
            "location" => "HN"
        ])->assertJsonMissing([
            "location" => "HCM"
        ])->assertJsonMissing([
            "location" => "DN"
        ]);
    }

    public function getSanctum($username, $password)
    {
        $response = $this->postJson('api/login', [
            'username' => $username,
            'password' => $password,
        ]);
        $response->assertStatus(200);
        return $response->getData();
    }
}
