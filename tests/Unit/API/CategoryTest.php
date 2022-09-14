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
    // use WithFaker;

    protected function create_user()
    {
        User::create([
            'name' => 'Testcategory',
            'email' => 'testcategory@example.com',
            'password' => Hash::make('testcategorypassword'),
        ]);
    }
    
    protected function authenticate()
    {
        if(!auth()->attempt(['email' => 'testcategory@example.com', 'password' => 'testcategorypassword'])){
            return response(['message' => 'Failed']);
        }

        return auth()->user()->createToken('LaravelAuthApp')->accessToken;
    }

    protected function delete_user()
    {
        User::where('email','testcategory@example.com')->delete();
    }

    protected function id_category()
    {
        return Category::select('id')->where('name', 'test category')->get();
    }

    public function test_create_category()
    {
        $this->create_user();

        $token = $this->authenticate();

        $response = $this->withHeaders(['Authorization' => 'Bearer'. $token])->json('POST', 'api/v1/categories', [
            'name' => 'test create category',
        ]);

        $response->assertStatus(201);
    }

    public function test_update_category()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders(['Authorization' => 'Bearer'. $token])->json('POST', 'api/v1/categories'. $this->id_category(), [
            'name' => 'test update category',
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

        $response = $this->withHeaders(['Authorization' => 'Bearer'. $token])->json('GET', 'api/v1/categories/'. $this->id_category());

        $response->assertStatus(200);
    }

    public function test_delete_category()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders(['Authorization' => 'Bearer'. $token])->json('DELETE', 'api/v1/categories/'. $this->id_category());

        $response->assertStatus(200);

        $this->delete_user();
    }
}
