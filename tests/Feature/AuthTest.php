<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthTest extends TestCase
{
    protected $user;
    public function setUp(): void
    {
        parent::setUp();
        $this->user = [
            'name'     => 'samuel gerges',
            'email'    => 'samuelgerges'.time().'@gmail.com',
            'username' => 'samuel10112'.time(),
            'password' => '1234',
        ];

    }



    public function test_register_user(): void
    {
        $response = $this->withHeaders(['is_api_call' => 'yes'])->post('/api/v1/auth/register', $this->user);
        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'name'     => 'samuel gerges',
            'email'    => 'samuelgerges'.time().'@gmail.com',
            'username' => 'samuel10112'.time(),
        ]);
    }

    public function test_register_user_exists_before(): void
    {
        $response = $this->withHeaders(['is_api_call' => 'yes'])->post('/api/v1/auth/register', $this->user);
        $response->assertStatus(406);

        $this->assertDatabaseHas('users', [
            'email'    => 'samuelgerges'.time().'@gmail.com',
            'username' => 'samuel10112'.time(),
        ]);
    }


    public function test_login_success(): void
    {
        $credentials = [
            'username' => $this->user['username'],
            'password' => $this->user['password'],
        ];
        $response = $this->withHeaders(['is_api_call' => 'yes'])->post('/api/v1/auth/login', $this->user);
        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'username' => $credentials['username'],
        ]);

    }

    public function test_login_failed(): void
    {
        $credentials = [
            'username' => 'username10',
            'password' => 'username',
        ];

        $response = $this->withHeaders(['is_api_call' => 'yes'])->post('/api/v1/auth/login', $credentials);
        $response->assertStatus(401);
        $this->assertDatabaseMissing('users', [
            'username' => $credentials['username'],
        ]);

    }

}
