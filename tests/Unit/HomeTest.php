<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_all_post()
    {
        $response = $this->get('/');

        $response->assertSee('');
    }

    public function test_show_post()
    {
        $response = $this->get('/posts');

        $response->assertSee('');
    }

}
