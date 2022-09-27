<?php

namespace Tests\Unit\API;

// use PHPUnit\Framework\TestCase;
use Laravel\Passport\Passport;
use Tests\TestCase;
use App\Models\Category;
use App\Models\User;

class CategoryTest extends TestCase
{
    protected function id_category()
    {
        return Category::latest()->first()->id;
    }

    public function test_store_category()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->post(route('categories.store'), [
            'name' => 'test create category',
        ]);

        $response->assertStatus(201)->assertJson(['status' => 'success', 'message' => 'Category stored successfully'])->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'name',
                'user_id',
                'updated_at',
                'created_at',
                'id',
            ]
        ]);
    }

    public function test_get_all_category()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->get(route('categories.index'));

        $response->assertStatus(200)->assertJson(['status' => 'success']);
    }

    public function test_show_category()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->get(route('categories.show', $this->id_category()));

        $response->assertStatus(200)->assertJson(['status' => 'success'])->assertJsonStructure([
            'status',
            'data' => [
                'id',
                'name',
                'user_id',
                'updated_at',
                'created_at',
            ]
        ]);
    }

    public function test_update_category()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->put(route('categories.update', $this->id_category()), [
            'name' => 'test update category',
        ]);

        $response->assertStatus(200)->assertJson(['status' => 'success', 'message' => 'Category update successfully']);
    }

    public function test_delete_category()
    {
        Passport::actingAs(User::factory()->create());
        
        $response = $this->delete(route('categories.destroy', $this->id_category()));

        $response->assertStatus(200)->assertJson(['status' => 'success', 'message' => 'Category deleted successfully']);
    }
}
