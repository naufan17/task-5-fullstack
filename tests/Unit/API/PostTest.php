<?php

namespace Tests\Unit\API;

// use PHPUnit\Framework\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\Passport;
use Tests\TestCase;
use App\Models\Category;
use App\Models\User;

class PostTest extends TestCase
{    
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected function id_category()
    {
        Category::create([
            'name' => 'test category',
        ]);

        return Category::select('id')->latest()->first();
    }

    public function test_store_post()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->json('POST', 'api/v1/posts', [
            'title' => 'test',
            'content' => 'test create post',
            'image' => 'image/jpg',
            'category_id' => $this->id_category()->id,
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

        Storage::disk('image')->assertExists($file->hashName());
    }

    public function test_update_post()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->json('POST', 'api/v1/posts/' . $this->id_category()->id, [
            'title' => 'test',
            'content' => 'test update post',
            'image' => 'image/jpg',
            'category_id' => $this->id_category()->id,
        ]);

        $response->assertStatus(200)->assertJson(['status' => 'success', 'message' => 'Post update successfully']);
    }

    public function test_get_all_post()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->json('GET', 'api/v1/posts');

        $response->assertStatus(200)->assertJson(['status' => 'success']);
    }

    public function test_show_post()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->json('GET', 'api/v1/posts/' . $this->id_category()->id);

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

    public function test_delete_post()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->json('DELETE', 'api/v1/posts/' . $this->id_category()->id);

        $response->assertStatus(200)->assertJson(['status' => 'success', 'message' => 'Post deleted successfully']);
    }
}
