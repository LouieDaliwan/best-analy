<?php

use Faker\Generator as Faker;
use Survey\Models\Field;
use Survey\Models\Submission;
use User\Models\User;

$factory->define(Submission::class, function (Faker $faker) {
    return [
        'results' => $faker->randomDigitNotNull(),
        'remarks' => $faker->words($nb = 3, $asText = true),
        'metadata' => json_encode($faker->words($nb = 3)),
        'submissible_id' => factory(Field::class)->create()->getKey(),
        'submissible_type' => get_class(new Field),
        'user_id' => function () {
            return factory(User::class)->create()->getKey();
        },
    ];
});
