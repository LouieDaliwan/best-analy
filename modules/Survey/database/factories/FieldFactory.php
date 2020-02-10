<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Survey\Models\Field;
use Survey\Models\Survey;

$factory->define(Field::class, function (Faker $faker) {
    return [
        'title' => $title = Str::title($faker->unique()->words($nb = 3, $asText = true)),
        'code' => Str::slug($title),
        'type' => 'text',
        'metadata' => $faker->words($nb = 10),
        'form_id' => function () {
            return factory(Survey::class)->create()->getKey();
        },
        'group' => $faker->word(),
    ];
});
