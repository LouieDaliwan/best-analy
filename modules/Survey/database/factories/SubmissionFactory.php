<?php

use Customer\Models\Customer;
use Faker\Generator as Faker;
use Survey\Models\Field;
use Survey\Models\Submission;
use User\Models\User;

$factory->define(Submission::class, function (Faker $faker) {
    return [
        'results' => $faker->randomDigitNotNull(),
        'remarks' => $faker->words($nb = 3, $asText = true),
        'metadata' => $faker->words($nb = 3),
        'submissible_id' => factory(Field::class)->create()->getKey(),
        'submissible_type' => get_class(new Field),
        'user_id' => function () {
            return factory(User::class)->create()->getKey();
        },
        'customer_id' => function () {
            return factory(Customer::class)->create()->getKey();
        },
    ];
});
