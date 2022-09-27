<?php

namespace Tests\Unit\API;

// use PHPUnit\Framework\TestCase;
use Laravel\Passport\Passport;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class PostTest extends TestCase
{    
    protected function id_category()
    {
        return Category::latest()->first()->id;
    }

    protected function id_post()
    {
        return Post::latest()->first()->id;
    }

    public function test_store_post()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->post('api/v1/posts', [
            'title' => 'test',
            'content' => 'test create post',
            'image' => 'image.jpg',
            'category_id' => $this->id_category(),
        ]);

        $response->assertStatus(201)->assertJson(['status' => 'success', 'message' => 'Post stored successfully'])->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'title',
                'content',
                'image',
                'user_id',
                'category_id',
                'updated_at',
                'created_at',
                'id',
            ]
        ]);
    }

    public function test_get_all_post()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->get(route('posts.index'));

        $response->assertStatus(200)->assertJson(['status' => 'success']);
    }

    public function test_show_post()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->get(route('posts.show', $this->id_post()));

        $response->assertStatus(200)->assertJson(['status' => 'success'])->assertJsonStructure([
            'status',
            'data' => [
                'title',
                'content',
                'image',
                'user_id',
                'category_id',
                'updated_at',
                'created_at',
                'id',
            ]
        ]);
    }

    public function test_update_post()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->put(route('posts.update', $this->id_post()), [
            'title' => 'test',
            'content' => 'test update post',
            'image' => 'image.jpg',
            'category_id' => $this->id_category(),
        ]);

        $response->assertStatus(200)->assertJson(['status' => 'success', 'message' => 'Post update successfully']);
    }

    public function test_delete_post()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->delete(route('posts.destroy', $this->id_post()));

        $response->assertStatus(200)->assertJson(['status' => 'success', 'message' => 'Post deleted successfully']);
    }
}
