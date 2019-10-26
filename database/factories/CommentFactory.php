<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'body' => $faker->paragraph(3),
        'commentable_id' => 1,
        'commentable_type' => 'App\Project'
    ];
});
