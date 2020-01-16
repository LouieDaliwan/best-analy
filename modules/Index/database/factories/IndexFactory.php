<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Index\Models\Index;
use User\Models\User;

$factory->define(Index::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->unique()->sentence(),
        'alias' => $faker->words(3, true),
        'code' => str_slug($name),
        'description' => $faker->paragraph(),
        'icon' => 'mdi mdi-pencil-outline',
        'type' => with(new Index)->getType(),
        'user_id' => factory(User::class)->create()->getKey(),
    ];
});
