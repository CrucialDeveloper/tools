<?php

/** @var Factory $factory */

use App\Task;
use App\Client;
use App\Project;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'client_id' => 1,
        'project_id' => 1,
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'status' => $faker->randomElement(['In Progress', 'Not Started', "Completed"]),
        'start_date' => $faker->dateTimeBetween($startDate = '-3 months', $endDate = 'now', $timezone = null),
        'due_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '1 year', $timezone = null),
        'priority' => $faker->randomElement(['P1', 'P2', 'P3']),
        'client_url_id' => Client::first()->url_id,
        'project_url_id' => Project::first()->url_id

    ];
});
