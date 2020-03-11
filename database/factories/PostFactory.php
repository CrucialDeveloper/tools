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
        'byline' => 'John Lowery',
        'image' => "https://picsum.photos/384/216?random=" . rand(1, 10),
        'video' => 'blob:https://vimeo.com/637cc814-59b8-4a94-bd7a-de0f77ec0fc2',
        'published_at' => date_format($faker->dateTimeThisYear(), 'Y-m-d H:i:s'),
        'slug' => Str::slug($title),
    ];
});
