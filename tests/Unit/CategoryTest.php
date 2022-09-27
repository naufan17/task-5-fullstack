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
        return Category::latest()->first();
    }

    public function test_store_category()
    {
        Passport::actingAs(User::factory()->create());

        $this->post(route('category.store'), [
            'name' => 'test store category',
        ]);

        $response = $this->get('categories');

        $response->assertSee('test store category');
    }

    public function test_update_category()
    {
        Passport::actingAs(User::factory()->create());

        $this->put(route('category.update', $this->id_category()->id), [
            'name' => 'test update category',
        ]);

        $response = $this->get('categories');

        $response->assertSee('test update category');
    }

    public function test_delete_category()
    {
        Passport::actingAs(User::factory()->create());

        $this->delete(route('category.destroy', $this->id_category()->id));

        $response = $this->get('categories');

        $response->assertDontSee($this->id_category()->name);
    }
}
