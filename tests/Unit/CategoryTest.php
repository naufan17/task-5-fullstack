<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Laravel\Passport\Passport;
use Tests\TestCase;
use App\Models\Category;
use App\Models\User;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected function id_category()
    {
        return Category::select('id')->latest()->first();
    }

    public function test_create_category()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->get('/categories');

        $response->assertSee('');       
    }

    public function test_store_category()
    {
        Passport::actingAs(User::factory()->create());
    }

    public function test_edit_category()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->get('/categories');

        $response->assertSee('');
    }

    public function test_update_category()
    {
        Passport::actingAs(User::factory()->create());
    }

    public function test_get_all_category()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->get('/categories');

        $response->assertSee('');
    }

    public function test_show_category()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->get('/categories');

        $response->assertSee('');
    }

    public function test_delete_category()
    {
        Passport::actingAs(User::factory()->create());
    }
}
