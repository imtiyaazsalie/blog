<?php

namespace Tests\Feature;

use App\Models\Post;
use Tests\TestCase;

class PostListTest extends TestCase
{

    public function testIndex()
    {
        $response = $this->call('GET', 'blog');
        $posts = $response->original->getData()['posts'];
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $posts);
    }
}
