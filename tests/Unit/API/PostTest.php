<?php

namespace Tests\Unit\API;

// use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;

class PostTest extends TestCase
{
    use WithFaker;
    
    protected function authenticate()
    {
        // $user = User::create([
        //     'name' => 'Testpost',
        //     'email' => 'testpost@example.com',
        //     'password' => Hash::make('testpostpassword'),
        // ]);

        !auth()->attempt(['email' => 'testpost@example.com', 'password' => 'testpostpassword']);

        return $accessToken = auth()->user()->createToken('LaravelAuthApp')->accessToken;
    }

    public function test_create_post()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders(['Authorization' => 'Bearer'. $token])->json('POST', 'api/v1/posts', [
            'title' => 'test',
            'content' => 'test create post',
            'image' => 'asdasda',
            'category_id' => $this->categories->random()->id,
        ]);

        $response->assertStatus(201);
    }

    public function test_update_post()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders(['Authorization' => 'Bearer'. $token])->json('POST', 'api/v1/posts'. user()->posts()->random()->id, [
            'title' => 'test',
            'content' => 'test update post',
            'image' => 'asdasda',
            'category_id' => $this->categories->random()->id,
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

        $response = $this->withHeaders(['Authorization' => 'Bearer'. $token])->json('GET', 'api/v1/posts/'. user()->posts()->random()->id);

        $response->assertStatus(200);
    }

    public function test_delete_post()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders(['Authorization' => 'Bearer'. $token])->json('DELETE', 'api/v1/posts/'. user()->posts()->random()->id);

        $response->assertStatus(200);
    }
}
