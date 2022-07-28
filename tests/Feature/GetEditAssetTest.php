<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AssetSeeder;
use Database\Seeders\CategorySeeder;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GetEditAssetTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed(CategorySeeder::class);
        $this->seed(AssetSeeder::class);
    }

    public function test_not_logged_in_user(): void
    {
        $id = 2;
        $this->json('GET', "api/asset/$id/edit")
            ->assertStatus(401);
    }

    public function test_not_admin(): void
    {
        $id = 2;
        Sanctum::actingAs(User::factory()->create([
            'admin' => false,
            'location' => 'DN',
            'staff_code' => 'SD2001',
            'base_username' => 'user',
        ]));
        $this->json('GET', "api/asset/$id/edit")
            ->assertStatus(401);
    }

    public function test_not_existed_asset(): void
    {
        $id = 200; //not existed asset
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'DN',
            'staff_code' => 'SD2001',
            'base_username' => 'user',
        ]));
        $this->json('GET', "api/asset/$id/edit")
            ->assertStatus(404);
    }

    public function test_asset_in_other_location(): void
    {
        $id = 2; //asset in DN
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'HN', //admin in HN
            'staff_code' => 'SD2001',
            'base_username' => 'user',
        ]));
        $this->json('GET', "api/asset/$id/edit")
            ->assertStatus(401);
    }

    public function test_assigned_asset(): void
    {
        $id = 1; //an assigned asset in HN
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'HN', //admin in HN
            'staff_code' => 'SD2001',
            'base_username' => 'user',
        ]));
        $this->json('GET', "api/asset/$id/edit")
            ->assertStatus(422);
    }

    public function test_success_get_edit(): void
    {
        $id = 2;
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'DN',
            'staff_code' => 'SD2001',
            'base_username' => 'user',
        ]));
        $this->json('GET', "api/asset/$id/edit")
            ->assertStatus(200);
    }

}
