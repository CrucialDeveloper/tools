<?php

namespace Tests\Feature;

use App\Client;
use App\Project;
use Carbon\Carbon;
use Tests\TestCase;
use App\TimeKeeping;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimeKeepingTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $client;
    protected $project;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->signIn();
        $this->client = $this->create(Client::class);
        $this->project = $this->create(Project::class);
    }

    /**
     * @test
     */
    public function a_timekeeping_entry_has_attributes()
    {
        $this->withoutExceptionHandling();

        $entry = $this->create(TimeKeeping::class, [
            'user_id' => 1,
            'client_id' => 1,
            'project_id' => 1,
            'start_time' => Carbon::now()->subMinutes(60),
            'end_time' => Carbon::now(),
            'description' => 'This is the description',
            'duration' => 60,
            'billable' => true,
            'client_url_id' => 'client url id',
            'project_url_id' => 'project url id'
        ]);

        $this->assertDatabaseHas('time_keepings', [
            'user_id' => 1,
            'client_id' => 1,
            'project_id' => 1,
            'start_time' => Carbon::now()->subMinutes(60),
            'end_time' => Carbon::now(),
            'description' => 'This is the description',
            'duration' => 60,
            'billable' => true,
            'client_url_id' => 'client url id',
            'project_url_id' => 'project url id'
        ]);
    }

    /**
     * @test
     */
    public function a_timekeeping_entry_can_be_created_from_a_post_route()
    {
        $this->withoutExceptionHandling();
        $entry = $this->raw(TimeKeeping::class);
        $response = $this->post("/clients/{$this->client->url_id}/projects/{$this->project->url_id}/timekeep", $entry);

        $this->assertCount(1, TimeKeeping::all());
    }

    /**
     * @test
     */
    public function a_timekeeping_entry_can_be_updated_from_an_update_route()
    {
        $this->withoutExceptionHandling();

        $entry = $this->create(TimeKeeping::class);

        $entry->start_time = Carbon::now()->subMinutes(120);
        $entry->end_time = Carbon::now()->addMinutes(15);
        $entry->description = "Updated description";

        $response = $this->patch("/clients/{$this->client->url_id}/projects/{$this->project->url_id}/timekeep/{$entry->id}", $entry->toArray());

        $this->assertDatabaseHas('time_keepings', [
            'start_time' => $entry->start_time,
            'end_time' => $entry->end_time,
            'description' => 'Updated description',
            'duration' => 135
        ]);
    }

    /**
     * @test
     */
    public function a_timekeeping_entry_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $entry = $this->create(TimeKeeping::class, [
            'client_url_id' => $this->client->url_id,
            'project_url_id' => $this->project->url_id
        ]);

        $this->assertCount(1, TimeKeeping::all());

        $response = $this->delete($entry->path);

        $this->assertCount(0, TimeKeeping::all());
    }
}
