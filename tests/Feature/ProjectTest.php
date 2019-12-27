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
            'parent_url_id' => '1234abcd',
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
            'parent_url_id' => '1234abcd',
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

    /**
     * @test
     */
    public function a_project_can_be_viewed_on_a_page()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();
        $client = $this->create(Client::class);
        $project = $this->create(Project::class);

        $response = $this->get($project->path);

        $response->assertStatus(200);
        $this->assertArrayHasKey('project', $response->getOriginalContent()->getData()['page']['props']);
        $this->assertEquals($project->id, $response->getOriginalContent()->getData()['page']['props']['project']['id']);
    }

    /**
     * @test
     */
    public function a_user_can_view_all_of_their_projects()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();
        $client1 = $this->create(Client::class);
        $projects1 = $this->create(Project::class, ['client_id' => $client1->id], 3);

        $client2 = $this->create(Client::class);
        $projects2 = $this->create(Project::class, ['client_id' => $client2->id], 3);

        $response = $this->get('/projects');

        $response->assertStatus(200);
        $this->assertArrayHasKey('projects', $response->getOriginalContent()->getData()['page']['props']);
        $this->AssertEquals($user->projects->modelKeys(), $response->getOriginalContent()->getData()['page']['props']['projects']->modelKeys());
    }

    /**
     * @test
     */
    public function projects_for_a_client_can_be_viewed_on_a_page()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();
        $client1 = $this->create(Client::class);
        $projects1 = $this->create(Project::class, ['client_id' => $client1->id], 3);

        $client2 = $this->create(Client::class);
        $projects2 = $this->create(Project::class, ['client_id' => $client2->id], 3);

        $response = $this->get("/clients/$client1->url_id/projects");

        $response->assertStatus(200);
        $this->assertArrayHasKey('projects', $response->getOriginalContent()->getData()['page']['props']);
        $this->AssertEquals($client1->projects->modelKeys(), $response->getOriginalContent()->getData()['page']['props']['projects']->modelKeys());
        $this->AssertNotEquals($client2->projects->modelKeys(), $response->getOriginalContent()->getData()['page']['props']['projects']->modelKeys());
    }
}
