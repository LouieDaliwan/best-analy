<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Best\Models\Report;
use Customer\Models\Customer;
use Faker\Generator as Faker;
use Index\Models\Index;
use Survey\Models\Survey;
use User\Models\User;

$factory->define(Report::class, function (Faker $faker) {
    return [
        'key' => $faker->word(),
        'value' => $faker->words($nb = 6, $asText = true),
        'remarks' => $faker->randomDigitNotNull(),
        'customer_id' => factory(Customer::class)->create()->getKey(),
        'form_id' => factory(Survey::class)->create()->getKey(),
        'user_id' => factory(User::class)->create()->getKey(),
    ];
});
