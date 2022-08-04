<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GetEditUserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
    }

    public function test_not_logged_in_admin()
    {
        $id = 1;
        $this->json('GET', "api/user/$id/edit")
            ->assertStatus(401);
    }

    public function test_user_is_not_an_admin()
    {
        $id = 1;
        Sanctum::actingAs(User::factory()->create([
            'admin' => false,
            'location' => 'HN',
            'staff_code' => 'SD2001',
            'base_username' => 'user',
        ]));
        $this->json('GET', "api/user/$id/edit")
            ->assertStatus(401);
    }

    public function test_user_is_not_existed()
    {
        $id = 20000;
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'HN',
            'staff_code' => 'SD2001',
            'base_username' => 'user',
        ]));
        $this->json('GET', "api/user/$id/edit")
            ->assertStatus(404);
    }

    public function test_not_same_location_user()
    {
        $id = 3; //user in HCM
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'HN',
            'staff_code' => 'SD2001',
            'base_username' => 'user',
        ]));
        $this->json('GET', "api/user/$id/edit")
            ->assertStatus(401);
    }

    public function test_get_user_edit_success(){
        $id = 1; //user in HN
        Sanctum::actingAs(User::factory()->create([
            'admin' => true,
            'location' => 'HN',
            'staff_code' => 'SD2001',
            'base_username' => 'user',
        ]));
        $this->json('GET', "api/user/$id/edit")
            ->assertStatus(200);
    }
}
