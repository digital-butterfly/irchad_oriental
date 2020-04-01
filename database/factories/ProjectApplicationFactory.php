<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProjectSheet;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

function fakeJson($label, $min, $max, $is_double) {

    $faker = \Faker\Factory::create();

    $result = [];

    $count = rand($min,$max);

    if (!$is_double) {
        for ($i = 1; $i <= $count; $i++) {
            array_push($result, (object)[
                $label => $faker->text($maxNbChars = 100),
            ]);
        }
    }

    else {
        for ($i = 1; $i <= $count; $i++) {
            array_push($result, (object)[
                'label' => $faker->word,
                'value' => $faker->numberBetween($min = 200, $max = 90000),
            ]);
        }
    }

    return json_encode($result);
}

$factory->define(ProjectSheet::class, function (Faker $faker) {
    return [
        

        'category_id' => $faker->randomElement($array = array (12,13,14,17,18)), 
        'township_id' => $faker->randomElement($array = array (5,9,10,13)), 
        'title' => $faker->catchPhrase, 
        'description' => $faker->text($maxNbChars = 300), 
        'market_type' => $faker->randomElement($array = array ('Marché Nationale','Marché Nationale et Export','Marché International')), 
        'holder_profile' => $faker->jobTitle, 
        'surface' => $faker->numberBetween($min = 200, $max = 90000), 
        'equipment' => $faker->text($maxNbChars = 200), 
        'production_value' => $faker->numberBetween($min = 200, $max = 90000), 
        'production_unit' => $faker->randomElement($array = array ('tonnes','unités','litres','Kg')), 
        'production_duration' => $faker->randomElement($array = array ('an','mois','trimestre')), 
        'turnover' => $faker->numberBetween($min = 500000, $max = 2000000), 
        'total_jobs' => $faker->numberBetween($min = 10, $max = 1000), 
        'total_investment' => $faker->numberBetween($min = 100000, $max = 2000000), 
        'strengths' => fakeJson('strengths', 1, 4, false), 
        'weaknesses' => fakeJson('weaknesses', 0, 4, false), 
        'financing_modes' => fakeJson(NULL, 0, 4, true), 
        'investment_program' => fakeJson(NULL, 0, 6, true), 
        'partnerships' => $faker->text($maxNbChars = 100), 
        'contacts' => $faker->text($maxNbChars = 100),
    ];
});
