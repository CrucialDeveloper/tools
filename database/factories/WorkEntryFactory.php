<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\WorkEntry;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(WorkEntry::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'client_id' => 1,
        'project_id' => 1,
        'start_time' => Carbon::now()->subMinutes(60)->timestamp,
        'end_time' => Carbon::now()->timestamp,
        'work_type' => 'Standard',
        'work_rate' => 25,
        'description' => $faker->paragraph(),
        'work_time' => $faker->numberBetween($min = 1000, $max = 18000000),
        'billable' => $faker->randomElement(["Yes", "No"]),
        'billed' => $faker->randomElement(["Yes", "No"]),
        'client_url_id' => 'client123',
        'project_url_id' => 'project123'
    ];
});
