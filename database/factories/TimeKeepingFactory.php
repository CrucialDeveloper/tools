<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Carbon\Carbon;
use App\TimeKeeping;
use Faker\Generator as Faker;

$factory->define(TimeKeeping::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'client_id' => 1,
        'project_id' => 1,
        'start_time' => Carbon::now()->subMinutes(60),
        'end_time' => Carbon::now(),
        'description' => $faker->paragraph(),
        'duration' => 60,
        'billable' => true,
        'client_url_id' => 'client123',
        'project_url_id' => 'project123'
    ];
});
