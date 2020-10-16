<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Session;
use Faker\Generator as Faker;

$factory->define(Session::class, function (Faker $faker) {
    return [
        'id_formation'=>$faker->randomElement($array = array (1,3,4,5)),
        'title'=> 'session '. $faker->jobTitle,
        'observation'=> $faker->text($maxNbChars = 100),
        'sort' => $faker->randomElement($array = array ('Terminée','En file d\'attente')),
        'start_date'=>$faker->dateTimeThisYear('+1 month'),
        'end_date'=>$faker->dateTimeThisYear('+1 week'),
        'max_inscrit'=>$faker->randomElement($array = array (12,14,15,18,19)),
    ];
});
