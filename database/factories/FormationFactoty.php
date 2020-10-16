<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Formation;
use Faker\Generator as Faker;

$factory->define(Formation::class, function (Faker $faker) {
    return [
         'title'=> $faker->jobTitle,
         'description'=> $faker->text($maxNbChars = 100),
         'domaine'=> $faker->text($maxNbChars = 20),

    ];
});
