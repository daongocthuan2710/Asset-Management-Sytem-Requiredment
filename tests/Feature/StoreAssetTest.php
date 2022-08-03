<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AssetSeeder;
use Database\Seeders\CategorySeeder;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StoreAssetTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed(CategorySeeder::class);
        $this->seed(AssetSeeder::class);
    }
    public function test_is_not_admin()
    {
        Sanctum::actingAs(User::factory()->create([
            'admin' => false,
            'location' => 'HN',
            'staff_code' => 'SD2001',
        ]));
        $body = [
            "name" => "Mouse",
            "category_id" => "LP",
            "installed_date" => "2000-07-06",
            "state" => 0,
            "specification" => "Non adipisci non quas quas.",
        ];
        $this->json('POST', 'api/asset', $body)->assertStatus(401);
    }
    public function test_require_name()
    {
        $body = [
            "name" => "",
            "category_id" => "LP",
            "installed_date" => "2000-07-06",
            "state" => 0,
            "specification" => "Non adipisci non quas quas.",
        ];
        $this->json('POST', 'api/asset', $body)->assertStatus(400);
    }
    public function test_category_does_not_exits()
    {
        $body = [
            "name" => "Mouse",
            "category_id" => "AB",
            "installed_date" => "2000-07-06",
            "state" => 0,
            "specification" => "Non adipisci non quas quas.",
        ];
        $this->json('POST', 'api/asset', $body)->assertStatus(400);
    }
    public function test_category_more_two_letters()
    {
        $body = [
            "name" => "Mousea",
            "category_id" => "LPP",
            "installed_date" => "31-12-2000",
            "state" => 0,
            "specification" => "Non adipisci non quas quas.",
        ];
        $this->json('POST', 'api/asset', $body)->assertStatus(400);
    }
    public function test_installed_date_not_a_datetime()
    {
        $body = [
            "name" => "Mousea",
            "category_id" => "LP",
            "installed_date" => "abc",
            "state" => 0,
            "specification" => "Non adipisci non quas quas.",
        ];
        $this->json('POST', 'api/asset', $body)->assertStatus(400);
    }
    public function test_state_invalid()
    {
        $body = [
            "name" => "Mouse",
            "category_id" => "LP",
            "installed_date" => "31-12-2000",
            "state" => 9,
            "specification" => "Non adipisci non quas quas.",
        ];
        $this->json('POST', 'api/asset', $body)->assertStatus(400);
    }
    public function test_specification_invalid()
    {
        $body = [
            "name" => "Mousea",
            "category_id" => "LP",
            "installed_date" => "31-12-2000",
            "state" => 0,
            "specification" => "",
        ];
        $this->json('POST', 'api/asset', $body)->assertStatus(400);
    }
    public function test_create_asset_success()
    {
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'HN',
            'staff_code' => 'SD2001',
        ]));
        $body = [
            "name" => "Mouse",
            "category_id" => "LP",
            "installed_date" => "31-12-2000",
            "state" => 0,
            "specification" => "Lorem is....",
        ];
        $this->json('POST', 'api/asset', $body)->assertStatus(201);
    }
}
