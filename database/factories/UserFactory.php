<?php

use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Channel::class, function ($faker) {
    $title = $faker->word;
    return [
        'name' => $title,
        'slug' => str_slug($title)
    ];
});
$factory->define(App\Tag::class, function ($faker) {
    return [
        'name' => $faker->unique()->word(),
    ];
});

$factory->define(App\Thread::class, function ($faker) {
    return [
        'user_id' =>  function () {
            return factory('App\User')->create()->id;
        },
        'channel_id' => function () {
            return factory('App\Channel')->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'replies_count' => 0,
        'created_at' => $faker->dateTimeBetween($start_date = '-40 days', $endDate = 'now')
    ];
});
$factory->define(App\Reply::class, function ($faker) {
    $users = User::all();
    return [
        'thread_id' => function () {
            return factory('App\Thread')->create()->id;
        },
        'user_id' => $users->random()->id,
        'message' => $faker->paragraph,
        'created_at' => $faker->dateTimeBetween($start_date = '-40 days', $endDate = 'now')
    ];
});
