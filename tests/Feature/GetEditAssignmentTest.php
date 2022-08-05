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

class GetEditAssignmentTest extends TestCase
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

    public function test_unlogged_user(){
        $id = 10; //staff_location: DN, state: 0
        $this->json('GET', "api/assignment/$id/edit")
            ->assertStatus(401);
    }

    public function test_not_an_admin_user(){
        $id = 10; //staff_location: DN, state: 0
        Sanctum::actingAs(User::findOrFail(39)); //admin: false, location: DN, state: 1
        $this->json('GET', "api/assignment/$id/edit")
            ->assertStatus(401);
    }

    public function test_not_existed_assignment(){
        $id = 20000; //un-existed assignment id
        Sanctum::actingAs(User::findOrFail(37)); //admin, location: DN, state: 1
        $this->json('GET', "api/assignment/$id/edit")
            ->assertStatus(404);
    }

    public function test_assignment_is_not_available(){
        $id = 9; //staff_location: DN, state: 1
        Sanctum::actingAs(User::findOrFail(37)); //admin, location: DN, state: 1
        $this->json('GET', "api/assignment/$id/edit")
            ->assertStatus(422);
    }

    // public function test_success_get_edit_assignment(){
    //     $id = 10; //staff_location: DN, state: 0
    //     Sanctum::actingAs(User::findOrFail(37)); //admin, location: DN, state: 1
    //     $this->json('GET', "api/assignment/$id/edit")
    //         ->assertStatus(200);
    // }
}
