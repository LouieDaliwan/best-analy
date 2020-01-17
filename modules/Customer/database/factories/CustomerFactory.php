<?php

use Customer\Models\Customer;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use User\Models\User;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'refnum' => $faker->randomNumber(),
        'code' => Str::slug($faker->unique()->words(3, $string = true)),
        'status' => 'pending',
        'user_id' => factory(User::class)->create()->getKey(),
    ];
});

