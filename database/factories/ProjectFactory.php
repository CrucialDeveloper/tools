<?php

use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Project::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'user_id' => 1,
        'client_id' => 1,
        'parent_url_id' => 'abc123',
        'title' => $title,
        'description' => $faker->paragraph,
        'status' => $faker->randomElement(['Not Started', 'In Progress', 'Complete']),
        'start_date' => Carbon::now(),
        'due_date' => $faker->dateTimeBetween('now', '+1 year', null),
        'priority' => $faker->randomElement(['P1', 'P2', 'P3']),
        'available_status' => [
            'Not Started', 'In Progress',
        ],
    ];
});
