<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Post;

class HomeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected function id_post()
    {
        return Post::latest()->first();
    }

    public function test_get_all_post()
    {
        $response = $this->get('/');

        $response->assertSee($this->id_post()->title);
        $response->assertSee($this->id_post()->content);
    }

    public function test_show_post()
    {
        $response = $this->get(route('post.show', $this->id_post()->id));

        $response->assertSee($this->id_post()->title);
        $response->assertSee($this->id_post()->content);
    }
}
