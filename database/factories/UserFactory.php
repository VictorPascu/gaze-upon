<?php

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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Domain\Signage\Playlists\PlaylistDefinition::class, function (Faker $faker) {
    return [
        'name' => $faker->text(50)
    ];
});

$factory->define(App\Domain\Signage\Playables\PlayableItemType::class, function (Faker $faker) {
    return [
        'type' => array_rand(["Vimeo", "YouTube"], 1),
    ];
});

$factory->define(App\Domain\Signage\Playables\PlayableItem::class, function (Faker $faker) {
    return [
        'name' => $faker->text(50),
        'duration' => $faker->numberBetween(1, 100),
        'path' => 'fake',
        'type_id' => 1
    ];
});
