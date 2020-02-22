<?php

namespace Tests\Feature;

use App\Client;
use App\Project;
use App\WorkEntry;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkEntryTest extends TestCase
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
    public function a_work_entry_has_attributes()
    {
        $this->withoutExceptionHandling();

        $entry = $this->create(WorkEntry::class, [
            'user_id' => 1,
            'client_id' => 1,
            'project_id' => 1,
            "start_time" => Carbon::createFromTimestampMs(1578361322011),
            "end_time" => Carbon::createFromTimestampMs(1578361332080),
            'work_type' => "Standard",
            'work_rate' => '25',
            "billable" => 'Yes',
            'billed' => 'No',
            "description" => "",
            "work_time" => 10067,
            'client_url_id' => 'client url id',
            'project_url_id' => 'project url id'
        ]);

        $this->assertDatabaseHas('work_entries', [
            'user_id' => 1,
            'client_id' => 1,
            'project_id' => 1,
            "start_time" => Carbon::createFromTimestampMs(1578361322011),
            "end_time" => Carbon::createFromTimestampMs(1578361332080),
            'work_type' => "Standard",
            "billable" => "Yes",
            'billed' => 'No',
            "description" => "",
            "work_time" => 10067,
            'client_url_id' => 'client url id',
            'project_url_id' => 'project url id'
        ]);
    }

    /**
     * @test
     */
    public function a_work_entry_can_be_created_from_a_post_route()
    {
        $this->withoutExceptionHandling();
        $entry = $this->raw(WorkEntry::class);
        $response = $this->post("/clients/{$this->client->url_id}/projects/{$this->project->url_id}/workentry", $entry);

        $this->assertCount(1, WorkEntry::all());
    }

    /**
     * @test
     */
    public function a_work_entry_can_be_updated_from_an_update_route()
    {
        $this->withoutExceptionHandling();

        $entry = $this->create(WorkEntry::class);

        $entry->start_time = Carbon::now()->subMinutes(120);
        $entry->end_time = Carbon::now()->addMinutes(15);
        $entry->description = "Updated description";

        $response = $this->patch("/clients/{$this->client->url_id}/projects/{$this->project->url_id}/workentry/{$entry->id}", $entry->toArray());

        $this->assertDatabaseHas('work_entries', [
            'start_time' => $entry->start_time,
            'end_time' => $entry->end_time,
            'description' => 'Updated description',
        ]);
    }

    /**
     * @test
     */
    public function a_work_entry_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $entry = $this->create(WorkEntry::class, [
            'client_url_id' => $this->client->url_id,
            'project_url_id' => $this->project->url_id
        ]);

        $this->assertCount(1, WorkEntry::all());

        $response = $this->delete($entry->path);

        $this->assertCount(0, WorkEntry::all());
    }
}
