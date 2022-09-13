<?php

namespace Tests\Unit\API;

// use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\Category;
use App\Models\User;

class CategoryTest extends TestCase
{
    // use RefreshDatabase;
    use WithFaker;
    
    protected function authenticate()
    {
        // $user = User::create([
        //     'name' => 'Testcategory',
        //     'email' => 'testcategory@example.com',
        //     'password' => Hash::make('testcategorypassword'),
        // ]);

        auth()->attempt(['email' => 'testcategory@example.com', 'password' => 'testcategorypassword']);

        return $accessToken = auth()->user()->createToken('LaravelAuthApp')->accessToken;
    }

    public function test_create_category()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders(['Authorization' => 'Bearer'. $token])->json('POST', 'api/v1/categories', [
            'name' => 'teknologi',
        ]);

        $response->assertStatus(201);
    }

    public function test_update_category()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders(['Authorization' => 'Bearer'. $token])->json('POST', 'api/v1/categories'. user()->categories()->random()->id, [
            'name' => 'informasi',
        ]);

        $response->assertStatus(200);
    }

    public function test_get_all_category()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders(['Authorization' => 'Bearer'. $token])->json('GET', 'api/v1/categories');

        $response->assertStatus(200);
    }

    public function test_show_category()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders(['Authorization' => 'Bearer'. $token])->json('GET', 'api/v1/categories/'. user()->categories()->random()->id);

        $response->assertStatus(200);
    }

    public function test_delete_category()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders(['Authorization' => 'Bearer'. $token])->json('DELETE', 'api/v1/categories/'. user()->categories()->random()->id);

        $response->assertStatus(200);
    }
}
