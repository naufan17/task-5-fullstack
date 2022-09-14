<?php

namespace Tests\Unit\API;

// use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class PostTest extends TestCase
{
    // use RefreshDatabase;
    // use WithFaker;
    
    protected function create_user()
    {
        User::create([
            'name' => 'Testpost',
            'email' => 'testpost@example.com',
            'password' => Hash::make('testpostpassword'),
        ]);
    }

    protected function create_category()
    {
        Category::create([
            'name' => 'test category',
        ]);
    }
    
    protected function authenticate()
    {
        auth()->attempt(['email' => 'testpost@example.com', 'password' => 'testpostpassword']);

        return  auth()->user()->createToken('LaravelAuthApp')->accessToken;
    }

    protected function delete_user()
    {
        User::where('email','testpost@example.com')->delete();
    }

    protected function id_category()
    {
        return Category::select('id')->where('name', 'test category')->get();
    }

    public function test_create_post()
    {
        $this->create_user();

        $token = $this->authenticate();

        $this->create_category();

        $response = $this->withHeaders(['Authorization' => 'Bearer'. $token])->json('POST', 'api/v1/posts', [
            'title' => 'test',
            'content' => 'test create post',
            'image' => 'asdasda',
            'category_id' => $this->id_category(),
        ]);

        $response->assertStatus(201);
    }

    public function test_update_post()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders(['Authorization' => 'Bearer'. $token])->json('POST', 'api/v1/posts'. $this->id_category(), [
            'title' => 'test',
            'content' => 'test update post',
            'image' => 'asdasda',
            'category_id' => $this->id_category(),
        ]);

        $response->assertStatus(200);
    }

    public function test_get_all_post()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders(['Authorization' => 'Bearer'. $token])->json('GET', 'api/v1/posts');

        $response->assertStatus(200);
    }

    public function test_show_post()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders(['Authorization' => 'Bearer'. $token])->json('GET', 'api/v1/posts/'. $this->id_category());

        $response->assertStatus(200);
    }

    public function test_delete_post()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders(['Authorization' => 'Bearer'. $token])->json('DELETE', 'api/v1/posts/'. $this->id_category());

        $response->assertStatus(200);

        $this->delete_user();
    }
}
