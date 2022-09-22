<?php

namespace Tests\Unit;

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
    protected function create_category()
    {
        Category::create([
            'name' => 'test category',
        ]);
    }

    protected function id_category()
    {
        return Category::select('id')->latest()->first();
    }

    public function test_create_post()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->get('/posts');

        $response->assertSee('');       
    }

    public function test_store_post()
    {
        Passport::actingAs(User::factory()->create());
    }

    public function test_edit_post()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->get('/posts');

        $response->assertSee('');
    }

    public function test_update_post()
    {
        Passport::actingAs(User::factory()->create());
    }

    public function test_get_all_post()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->get('/posts');

        $response->assertSee('');
    }

    public function test_show_post()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->get('/posts');

        $response->assertSee('');
    }

    public function test_delete_post()
    {
        Passport::actingAs(User::factory()->create());
    }
}
