<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\TestCase;


class BlogPostTest extends TestCase
{
    use DatabaseMigrations;
    
    public function testBlogViews()
    {
        $response = $this->call("GET", "/blog");
        $this->assertEquals(200, $response->status());
    }
}
