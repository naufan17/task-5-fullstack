<?php

namespace Tests\Unit\API;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_register()
    {
        $response = $this->json('POST', 'api/v1/register', [
            'name' => 'TestAuth',
            'email' => 'testauth@example.com',
            'password' => 'testauthpassword',
        ]);

        $response->assertStatus(200)->assertJsonStructure(['token']);
    }

    public function test_login()
    {
        $response = $this->json('POST', 'api/v1/login', [
            'email' => 'testauth@example.com',
            'password' => 'testauthpassword',
        ]);

        $response->assertStatus(200)->assertJsonStructure(['token']);
    }

    public function test_logout()
    {
        if(!auth()->attempt(['email' => 'testauth@example.com', 'password' => 'testauthpassword'])){
            return response(['message' => 'Failed']);
        }

        $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer '. $token])->json('POST', 'api/v1/logout');
        
        $response->assertStatus(200)->assertJson(['message' => 'Logout successfully and token was deleted']);

        User::where('email', 'testauth@example.com')->delete();
    }
}
