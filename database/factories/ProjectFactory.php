<?php

use App\Client;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'user_id' => 1,
        'client_id' => 1,
        'parent_url_id' => Client::first()->url_id,
        'title' => $title,
        'description' => $faker->paragraph,
        'status' => $faker->randomElement(['Not Started', 'In Progress', 'Complete']),
        'start_date' => Carbon::now(),
        'due_date' => $faker->dateTimeBetween('now', '+1 year', null),
        'priority' => $faker->randomElement(['P1', 'P2', 'P3']),
        'available_status' => [['Not Started', 'Not Started'], ['In Progress', 'In Progress']],
        'work_type' => [
            ['Standard', 'Standard', 100],
        ]
    ];
});
