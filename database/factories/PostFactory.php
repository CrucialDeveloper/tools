<?php

use App\Post;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'title' => $title,
        'body' => $faker->paragraph,
        'excerpt' => $faker->paragraph,
        'image' => $faker->url,
        'video' => $faker->url,
        'published_at' => date_format($faker->dateTimeThisYear(), 'Y-m-d H:i:s'),
        'slug' => Str::slug($title),
    ];
});
