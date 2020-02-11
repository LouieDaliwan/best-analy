<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Survey\Models\Survey;
use Taxonomy\Models\Taxonomy;
use User\Models\User;

$factory->define(Survey::class, function (Faker $faker) {
    return [
        'title' => $title = Str::title($faker->unique()->words($nb = 3, $asText = true)),
        'code' => Str::slug($title),
        'body' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'metadata' => json_encode($faker->words($nb = 10)),
        'type' => 'survey',
        'formable_id' => function () {
            return factory(Taxonomy::class)->create()->getKey();
        },
        'formable_type' => get_class(new Taxonomy),
        'user_id' => function () {
            return factory(User::class)->create()->getKey();
        },
    ];
});
