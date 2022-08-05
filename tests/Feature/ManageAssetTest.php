<?php

namespace Tests\Feature;

use Tests\TestCase;
use Database\Seeders\CategorySeeder;
use Database\Seeders\AssetSeeder;
use Database\Seeders\UserSeeder;

class ManageAssetTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed(CategorySeeder::class);
        $this->seed(AssetSeeder::class);
        $this->seed(UserSeeder::class);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_staff_could_not_access()
    {
        $santumUser = $this->getSanctum("tuandd", "12345");

        $viewAsset = $this->getJson('api/asset', [
            'Authorization' => "Bearer $santumUser->token"
        ]);
        $viewAsset->assertStatus(401);
    }

    public function test_admin_can_only_manage_asset_in_the_same_location()
    {
        $santumUser = $this->getSanctum("quytc", "12345");

        $viewAsset = $this->getJson('api/asset', [
            'Authorization' => "Bearer $santumUser->token"
        ]);
        $viewAsset->assertStatus(200)->assertJsonFragment([
            "location" => "HN"
        ])->assertJsonMissing([
            "location" => "HCM"
        ])->assertJsonMissing([
            "location" => "DN"
        ]);;
    }

    public function test_admin_can_view_asset_detail()
    {
        $santumUser = $this->getSanctum("bichvht", "12345");

        $viewAsset = $this->getJson('api/asset/5', [
            'Authorization' => "Bearer $santumUser->token"
        ]);
        $viewAsset->assertStatus(200)->assertJsonFragment([
            "id" => 5
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
