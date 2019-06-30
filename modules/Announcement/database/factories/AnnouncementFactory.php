<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Announcement\Models\Announcement;
use Faker\Generator as Faker;
use Taxonomy\Models\Category;
use User\Models\User;

$factory->define(Announcement::class, function (Faker $faker) {
    return [
        'title' => $name = $faker->unique()->words(4, true),
        'slug' =>  str_slug($name),
        'body' =>  $faker->paragraph(),
        'photo' =>  $faker->imageUrl(),
        'type' =>  'announcement',
        'user_id' => factory(User::class)->create()->id,
        'category_id' => factory(Category::class)->create()->id,
    ];
});
