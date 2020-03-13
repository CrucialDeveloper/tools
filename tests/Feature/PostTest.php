<?php

namespace Tests\Feature;

use App\Post;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

    /**
     * @test
     */
    public function a_post_can_be_created_from_a_post_request()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn(['email' => 'john@crucialdeveloper.com']);

        $post = $this->make(Post::class);

        $response = $this->post('/blog', $post->toArray());

        $this->assertCount(1, Post::all());
        $this->assertDatabaseHas('posts', [
            'title' => $post->title,
            'excerpt' => $post->excerpt,
            'body' => $post->body,
            'byline' => $post->byline,
            'image' => $post->image,
            'video' => $post->video,
            'slug' => Str::slug($post->title)
        ]);
    }

    /**
     * @test
     */
    public function a_post_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn(['email' => 'john@crucialdeveloper.com']);

        $post = $this->create(Post::class);

        $post->title = 'Updated Title';

        $this->patch($post->path, $post->toArray());

        $this->assertDatabaseHas('posts', ['title' => 'Updated Title']);
    }
}
