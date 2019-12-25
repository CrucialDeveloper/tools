<?php

use App\Client;
use App\Project;
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
        $clients = factory(Client::class, 50)->create();

        foreach ($clients as $client) {
            factory(Project::class, 10)->create(['client_id' => $client->id]);
        }
    }
}
