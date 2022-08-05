<?php

namespace Tests\Feature;

use App\Models\Asset;
use App\Models\Assignment;
use App\Models\Category;
use App\Models\User;
use Database\Seeders\AssetSeeder;
use Database\Seeders\AssignmentSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GetDeleteAssignmentTest extends TestCase
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
    public function test_not_logged_user(){
        $id = 10; //staff_location: DN, state: 0
        $this->json('GET', "api/can-delete-assignment/$id")
            ->assertStatus(401);
    }
    public function test_not_an_admin(){
        $id = 10; //staff_location: DN, state: 0
        Sanctum::actingAs(User::findOrFail(39)); //admin: false, location: DN, state: 1
        $this->json('GET', "api/can-delete-assignment/$id")
            ->assertStatus(401);
    }
    public function test_not_same_location(){
        $id = 2; //staff_location: HCM, state: 0
        Sanctum::actingAs(User::findOrFail(37)); //admin, location: DN, state: 1
        $this->json('GET', "api/can-delete-assignment/$id")
            ->assertStatus(401);
    }
    // public function test_delete_accepted_assignment(){
    //     $id = 9; //staff_location: DN, state: 1
    //     Sanctum::actingAs(User::findOrFail(37)); //admin, location: DN, state: 1
    //     $this->json('GET', "api/can-delete-assignment/$id")
    //         ->assertStatus(422);
    // }
    public function test_success_get_can_delete_assignment(){
        $id = 10; //staff_location: DN, state: 0
        Sanctum::actingAs(User::findOrFail(37)); //admin, location: DN, state: 1
        $this->json('GET', "api/can-delete-assignment/$id")
            ->assertStatus(200);
    }
}