<?php

use Core\Enumerations\Role as RoleCode;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use User\Models\User;

$factory->define(User::class, function (Faker $faker) {
    return [
        'prefixname' => $faker->title(),
        'firstname' => $faker->firstName(),
        'middlename' => $faker->lastName(),
        'lastname' => $faker->lastName(),
        'email' => $email = $faker->unique()->email(),
        'username' => str_slug($email),
        'password' => $faker->password,
        'type' => RoleCode::TEST,
    ];
});
