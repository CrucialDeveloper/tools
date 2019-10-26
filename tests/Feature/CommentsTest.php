<?php

namespace Tests\Feature;

use App\Client;
use App\Comment;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function comments_have_attributes()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();
        $client = $this->create(Client::class);
        $project = $this->create(Project::class);

        $comment = $this->raw(Comment::class, [
            'project_id' => $project->url_id
        ]);

        $this->post("/clients/$client->url_id/projects/$project->url_id/comments", $comment);

        $this->assertDatabaseHas('comments', [
            'body' => $comment['body'],
        ]);
    }

    /**
     * @test
     */
    public function a_comment_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->signIn();
        $comment = $this->create(Comment::class);

        $this->assertCount(1, Comment::all());

        $this->patch("comments/$comment->url_id", [
            'body' => 'Updated Body'
        ]);

        $this->assertCount(1, Comment::all());
        $this->assertDatabaseHas('comments', [
            'body' => 'Updated Body'
        ]);
    }

    /**
     * @test
     */
    public function comments_belong_to_projects_and_users()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $project = $this->create(Project::class);

        $comments = $this->create(Comment::class, [
            'user_id' => $user->id,
            'commentable_id' => $project->id,
            "commentable_type" => get_class($project)
        ], 3);

        $this->assertCount(3, Comment::all());

        $this->assertCount(3, $project->comments);
        $this->assertCount(3, $user->comments);
    }

    /**
     * @test
     */
    public function comments_know_who_made_the_comment()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $project = $this->create(Project::class);

        $comment = $this->create(Comment::class, [
            'user_id' => $user->id,
            'commentable_id' => $project->id,
            "commentable_type" => get_class($project)
        ]);

        $this->assertEquals($user->id, $comment->commenter->id);
    }
}
