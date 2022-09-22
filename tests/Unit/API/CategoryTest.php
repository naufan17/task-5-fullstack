<?php

namespace Tests\Unit\API;

// use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Hash;
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

    public function test_store_category()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->json('POST', 'api/v1/categories', [
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

    public function test_update_category()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->json('POST', 'api/v1/categories/' . $this->id_category()->id, [
            'name' => 'test update category',
        ]);

        $response->assertStatus(200)->assertJson(['status' => 'success', 'message' => 'Category update successfully']);
    }

    public function test_get_all_category()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->json('GET', 'api/v1/categories');

        $response->assertStatus(200)->assertJson(['status' => 'success']);
    }

    public function test_show_category()
    {
        Passport::actingAs(User::factory()->create());

        $response = $this->json('GET', 'api/v1/categories/' . 65);

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

    public function test_delete_category()
    {
        Passport::actingAs(User::factory()->create());
        
        $response = $this->json('DELETE', 'api/v1/categories/' . $this->id_category()->id);

        $response->assertStatus(200)->assertJson(['status' => 'success', 'message' => 'Category deleted successfully']);
    }
}
