<?php

/** @var Factory $factory */

use App\WorkEntry;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(WorkEntry::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'project_id' => 1,
        'start_date' => Carbon::now(),
        'end_date' => Carbon::now()->addHours(5),
        'description' => $faker->paragraph(5),
        'billable' => $faker->boolean(80)
    ];
});
