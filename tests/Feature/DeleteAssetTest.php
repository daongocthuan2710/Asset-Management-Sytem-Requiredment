<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AssetSeeder;
use Database\Seeders\CategorySeeder;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DeleteAssetTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed(CategorySeeder::class);
        $this->seed(AssetSeeder::class);
    }
    public function test_is_admin(): void
    {
        $id = 2;
        Sanctum::actingAs(User::factory()->create([
            'admin' => false,
        ]));
        $this->json('DELETE', "api/asset/$id")
            ->assertStatus(401);
    }
    public function test_delete_success(): void
    {
        $id = 1;
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
        ]));
        $this->json('DELETE', "api/asset/$id")
            ->assertStatus(200);
    }
}
