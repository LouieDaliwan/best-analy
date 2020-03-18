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
        'value' => json_encode($faker->words($nb = 6, $asText = false)),
        'remarks' => $faker->randomDigitNotNull(),
        'customer_id' => function () {
            return factory(Customer::class)->create()->getKey();
        },
        'form_id' => function () {
            return factory(Survey::class)->create()->getKey();
        },
        'user_id' => function () {
            return factory(User::class)->create()->getKey();
        },
    ];
});
