<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'company_name' => "Company Name",
        'address' => "123 Example St.",
        'phone_number' => '555-555-5555',
    ];
});
