<?php

namespace Tests\Feature;

use App\Task;
use App\Client;
use App\Project;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function tasks_have_attributes()
    {
        $this->withoutExceptionHandling();

        $task = $this->create(Task::class);

        $this->assertDatabaseHas('tasks', [
            'title' => $task->title,
            'description' => $task->description,
            'status' => $task->status,
        ]);
    }

    /**
     * @test
     */
    public function a_task_can_be_created()
    {
        $this->withoutExceptionHandling();

        $task = $this->raw(Task::class);
        $user = $this->signIn();

        $client = $this->create(Client::class, ['user_id' => $user->id]);
        $project = Project::first();

        $this->post("/clients/$client->url_id/projects/$project->url_id/tasks", $task);
        $this->assertDatabaseHas('tasks', ['title' => $task['title']]);
    }

    /**
     * @test
     */
    public function a_tasks_status_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $task = factory(Task::class)->create([
            'status' => 'Not Started',
            'user_id' => 1,
            'client_id' => 1,
            'project_id' => 1,
        ]);

        $this->assertDatabaseHas('tasks', ['status' => 'Not Started']);

        $this->post("/task/$task->url_id", [
            'status' => 'In Progress',
        ]);

        $this->assertDatabaseHas('tasks', ['status' => 'In Progress']);
    }

    /**
     * @test
     */
    public function a_tasks_attributes_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $user = $this->signIn();
        $client = $this->create(Client::class, ['user_id' => $user->id]);
        $project = $this->create(Project::class, ['user_id' => $user->id, 'client_id' => $client->id]);
        $task = $this->create(Task::class, ['user_id' => 1, "project_id" => 1]);

        $task->title = 'updated';
        $response = $this->patch(
            "/clients/$client->url_id/projects/$project->url_id/tasks/$task->url_id",
            $task->toArray()
        );

        $this->assertDatabaseHas('tasks', ['title' => 'updated']);
    }
}
