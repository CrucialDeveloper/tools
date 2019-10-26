<?php

namespace Tests\Feature;

use App\Client;
use App\Project;
use App\WorkEntry;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkEntryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_time_tracking_item_has_attributes()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();
        $entry = $this->create(WorkEntry::class, ['user_id' => $user->id]);


        $this->assertDatabaseHas('work_entries', [
            'id' => $entry->id,
            'user_id' => $user->id,
            'start_date' => $entry->start_date,
            'end_date' => $entry->end_date,
            'description' => $entry->description,
            'billable' => $entry->billable
        ]);
    }

    /**
     * @test
     */
    public function a_work_entry_item_can_be_created_from_a_post_request()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();
        $client = $this->create(Client::class);
        $project = $this->create(Project::class);
        $entry = $this->raw(WorkEntry::class, ['user_id' => $user->id]);

        $this->post("/clients/$client->url_id/projects/$project->url_id/work", $entry);

        $this->assertDatabaseHas('work_entries', $entry);
    }

    /**
     * @test
     */
    public function a_work_entry_item_can_be_updated_with_and_patch_request()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();
        $client = $this->create(Client::class);
        $project = $this->create(Project::class);
        $entry = $this->create(WorkEntry::class, ['user_id' => $user->id]);

        $this->patch("/clients/$client->url_id/projects/$project->url_id/work/$entry->url_id", [
            'description' => 'Updated Description'
        ]);

        $this->assertDatabaseHas('work_entries', [
            'description' => 'Updated Description'
        ]);
    }

    /**
     * @test
     */
    public function a_user_can_get_all_of_their_work_entries()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();
        $entries = $this->create(WorkEntry::class, ['user_id' => $user->id], 5);

        $this->assertCount(5, WorkEntry::all());

        $this->assertCount(5, $user->work_items);
    }
}
