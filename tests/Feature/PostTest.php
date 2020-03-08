<?php

namespace Tests\Feature;

use App\Post;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function all_posts_can_be_viewed_by_anybody()
    {
        $this->withoutExceptionHandling();
        $user = $this->signIn();
        $post = factory(Post::class)->create();

        $response = $this->get('/blog');

        $posts = Post::all();

        $this->assertTrue($posts->contains($post));
        $this->assertArrayHasKey('posts', $response->getOriginalContent()->getData()['page']['props']);
        $this->assertEqualsCanonicalizing($posts, $response->getOriginalContent()->getData()['page']['props']['posts']);
    }

    /**
     * @test
     */
    public function a_single_post_can_be_viewed_by_anybody()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();
        $post = factory(Post::class)->create();

        $response = $this->get("/blog/$post->slug");

        $this->assertArrayHasKey('post', $response->getOriginalContent()->getData()['page']['props']);
        $this->assertEqualsCanonicalizing($post->id, $response->getOriginalContent()->getData()['page']['props']['post']['id']);
    }

    /**
     * @test
     */
    public function only_published_posts_can_be_viewed()
    {
        $this->withoutExceptionHandling();

        $published = factory(Post::class)->create(['published_at' => Carbon::now()]);

        $unpublished = factory(Post::class)->create(['published_at' => null]);
        $future = factory(Post::class)->create(['published_at' => Carbon::tomorrow()]);

        $posts = Post::published();

        $this->assertTrue($posts->contains($published));
        $this->assertFalse($posts->contains($unpublished));
        $this->assertFalse($posts->contains($future));
    }
}
