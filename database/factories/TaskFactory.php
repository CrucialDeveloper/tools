<?php

/** @var Factory $factory */

use App\Task;
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
        'parent_url_id' => Project::first()->url_id

    ];
});
