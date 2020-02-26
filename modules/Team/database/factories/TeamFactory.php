<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Team\Models\Team;
use User\Models\User;

$factory->define(Team::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->unique()->company(),
        'code' => Str::slug($name),
        'description' => $faker->text(),
        'icon' => 'mdi mdi-pencil',
        'user_id' => function () {
            return factory(User::class)->create()->getKey();
        },
    ];
});
