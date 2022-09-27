<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Illuminate\Http\UploadedFile;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Post;
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
        return Category::latest()->first()->id;
    }

    protected function id_post()
    {
        return Post::latest()->first();
    }

    public function test_store_post()
    {
        Storage::fake('images');
 
        $file = UploadedFile::fake()->image('image.jpg');

        Passport::actingAs(User::factory()->create());

        $this->post(route('post.store'), [
            'title' => 'test',
            'content' => 'test store post',
            'image' => $file,
            'category_id' => $this->id_post()->id,
        ]);

        $response = $this->get('posts');

        $response->assertSee('test');
        $response->assertSee('test store post');  

        Storage::disk('images')->assertExists('image.jpg');
        Storage::disk('images')->assertMissing('missing.jpg');
    }

    public function test_update_post()
    {
        Storage::fake('images');
 
        $file = UploadedFile::fake()->image('image.jpg');

        Passport::actingAs(User::factory()->create());

        $this->put(route('post.update', $this->id_post()->id), [
            'title' => 'test',
            'content' => 'test update post',
            'image' => $file,
            'category_id' => $this->id_post()->id,
        ]);

        $response = $this->get('posts');

        $response->assertSee('test');
        $response->assertSee('test update post');  

        Storage::disk('images')->assertExists('image.jpg');
        Storage::disk('images')->assertMissing('missing.jpg');
    }

    public function test_delete_post()
    {
        Passport::actingAs(User::factory()->create());

        $this->delete(route('post.destroy', $this->id_post()->id));

        $response = $this->get('posts');

        $response->assertDontSee($this->id_post()->title);
        $response->assertDontSee($this->id_post()->content);
    }
}
