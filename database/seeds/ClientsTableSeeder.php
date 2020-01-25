<?php

use App\Task;
use App\Client;
use App\Comment;
use App\Project;
use App\WorkEntry;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = factory(Client::class, 1)->create();

        foreach ($clients as $client) {
            factory(Project::class, 1)->create([
                'client_id' => $client->id,
                'parent_url_id' => $client->url_id
            ])->each(function ($project) use ($client) {
                factory(Task::class, 5)->create([
                    'client_id' => $client->id,
                    'project_id' => $project->id,
                    'client_url_id' => $client->url_id,
                    'project_url_id' => $project->url_id
                ]);
                factory(WorkEntry::class, 5)->create([
                    'client_id' => $client->id,
                    'client_url_id' => $client->url_id,
                    'project_id' => $project->id,
                    'project_url_id' => $project->url_id,
                ]);
                factory(Comment::class, 5)->create();
            });
        }
    }
}
