<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->word(5, true),
        'body' => $faker->sentences(10, true),
        'is_published' => $faker->boolean(70),
        'user_id' => User::inRandomOrder()->first()->id
    ];
});
