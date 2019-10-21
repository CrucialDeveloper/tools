<?php

namespace Tests\Feature;

use App\Task;
use App\Client;
use App\Project;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_project_has_attributes()
    {
        $this->withoutExceptionHandling();
        $user = $this->signIn();
        $project = $this->create(Project::class, [
            'user_id' => $user->id,
            'client_id' => factory(Client::class)->create(['user_id' => $user->id]),
            'title' => 'A project Title',
            'description' => 'Project Description',
            'status' => 'Not Started',
            'start_date' => Carbon::now(),
            'due_date' => Carbon::now(),
            'priority' => "P1",
            'available_status' => [
                'Not Started', 'In Progress',
            ],
        ]);

        $this->assertDatabaseHas('projects', [
            'title' => 'A project Title',
            'description' => 'Project Description',
            'status' => 'Not Started',
            'start_date' => Carbon::now(),
            'due_date' => Carbon::now(),
            'priority' => "P1",
        ]);
    }

    /**
     * @test
     */
    public function a_project_can_be_created()
    {
        $this->withoutExceptionHandling();

        $project = $this->raw(Project::class);

        $user = $this->signIn();
        $client = $this->create(Client::class, ['user_id' => $user->id]);

        $project['client_id'] = $client->id;

        $this->post("/clients/$client->url_id/projects", $project);
        $this->assertDatabaseHas('projects', ['title' => $project['title']]);
    }

    /**
     * @test
     */
    public function a_project_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();
        $client = $this->create(Client::class, ['user_id' => $user->id]);
        $project = $this->create(Project::class, ['user_id' => $user->id, 'client_id' => $client->id]);
        $project->title = "Updated Title";
        $response = $this->patch("/clients/$client->url_id/projects/$project->url_id", $project->toArray());
        $this->assertDatabaseHas('projects', ['title' => 'Updated Title']);
    }

    /**
     * @test
     */
    public function a_project_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();
        $client = $this->create(Client::class, ['user_id' => $user->id]);
        $project = $this->create(Project::class, ['user_id' => $user->id, 'client_id' => $client->id]);

        $this->assertDatabaseHas('projects', ['title' => $project->title]);
        $response = $this->delete("/clients/$client->url_id/projects/$project->url_id");

        $this->assertDatabaseMissing('projects', ['title' => $project->title]);
    }

    /**
     * @test
     */
    public function a_project_knows_if_it_is_past_due()
    {
        $this->withoutExceptionHandling();

        $project = $this->create(Project::class, [
            'user_id' => 1,
            'client_id' => 1,
            'due_date' => Carbon::yesterday()
        ]);

        $this->assertTrue($project->past_due);
    }

    /**
     * @test
     */
    public function a_project_knows_if_it_is_not_past_due()
    {
        $this->withoutExceptionHandling();

        $project = $this->create(Project::class, [
            'user_id' => 1,
            'client_id' => 1,
            'due_date' => Carbon::tomorrow()
        ]);

        $this->assertFalse($project->past_due);
    }
}
