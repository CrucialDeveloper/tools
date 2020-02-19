<?php

/** @var Factory $factory */

use App\Client;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'company_name' => $faker->company,
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'zip' => $faker->postcode,
        'country' => 'USA',
        'phone_number' => $faker->phoneNumber,
        'website' => $faker->url,
        'project_status_options' => ['New', 'Spike', 'Not Started', 'In Progress', 'Completed'],
        'work_type' => [
            ['coding' => 50],
            ['meeting' => 30]
        ]
    ];
});
