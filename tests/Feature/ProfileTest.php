<?php

namespace Tests\Feature;
use Database\Seeders\UserSeeder;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_example()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }


    public function test_profile()
    {
        $response = $this->postJson('api/login', [
            'username' => 'datdn',
            'password' => '12345',
        ]);
        $response->assertStatus(200);
        $token = $response->getData()->token;
        $response = $this->getJson('user-information', [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function test_get_token(){
        $response = $this->postJson('api/login', [
            'username' => 'datdn',
            'password' => '12345',
        ]);
        $response->assertStatus(200);
    }


    public function test_all_fields_has_not_been_entered_when_state_is_1()
    {
        $response = $this->postJson('api/login', [
            'username' => 'datdn',
            'password' => '12345',
        ]);
        $response->assertStatus(200);
        $token = $response->getData()->token;
        $body = [
            "oldPassword" => "",
            "newPassword" => "12345",
        ];

        $this->json('POST', 'api/profile', $body, [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])
            ->assertStatus(422);

    }

    public function test_all_fields_has_been_entered_when_state_is_1()
    {
        $token = $this->test_get_token();
        $body = [
            "oldPassword" => "12345",
            "newPassword" => "12345"
        ];

        $this->json('POST', 'api/profile', $body, [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])
            ->assertStatus(200);

    }

    public function test_all_fields_has_not_been_entered_when_state_is_0()
    {
        $token = $this->test_get_token();
        $body = [
            "newPassword" => "",
        ];

        $this->json('POST', 'api/profile', $body, [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])
            ->assertStatus(422);

    }

    public function test_all_fields_has_been_entered_when_state_is_0()
    {
        $token = $this->test_get_token();
        $body = [
            "newPassword" => "12345"
        ];

        $this->json('POST', 'api/profile', $body, [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])
            ->assertStatus(200);

    }


    public function test_old_password_is_incorrect()
    {
        $token = $this->test_get_token();
        $body = [
            "oldPassword" => "wrong-password",
            "newPassword" => "12345",
        ];

        $this->json('POST', 'api/profile', $body, [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
            ])
            ->assertStatus(404);

    }


}
