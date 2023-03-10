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

function fakeJson($label, $min, $max, $repeater_type) {

    $faker = \Faker\Factory::create();

    $result = [];

    $count = rand($min,$max);

    if (!($repeater_type == 'double') && !($repeater_type == 'triple') && !($repeater_type == 'quadruple')){
        for ($i = 1; $i <= $count; $i++) {
            array_push($result, [
                $label => $faker->text($maxNbChars = 100),
            ]);
        }
    }

    elseif ($repeater_type == 'triple'){
        for ($i = 1; $i <= $count; $i++) {
            array_push($result, [
                'label' => $faker->jobTitle,
                'count' => $faker->numberBetween($min = 1, $max = 20),
                'value' => $faker->numberBetween($min = 3000, $max = 7000),
            ]);
        }
    }

    elseif ($repeater_type == 'quadruple'){
        for ($i = 1; $i <= $count; $i++) {
            array_push($result, [
                'label' => $faker->jobTitle,
                'value' => $faker->numberBetween($min = 30000, $max = 70000),
                'rate' => $faker->numberBetween($min = 1, $max = 20),
                'duration' => $faker->numberBetween($min = 2, $max = 10),
            ]);
        }
    }

    else {
        for ($i = 1; $i <= $count; $i++) {
            array_push($result, [
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
        'market_type' => $faker->randomElement($array = array ('March?? National','March?? National et Export','March?? International')), 
        'holder_profile' => $faker->jobTitle, 
        'surface' => $faker->numberBetween($min = 200, $max = 90000), 
        'equipment' => $faker->text($maxNbChars = 200), 
        'production_value' => $faker->numberBetween($min = 200, $max = 90000), 
        'production_unit' => $faker->randomElement($array = array ('tonnes','unit??s','litres','Kg')), 
        'production_duration' => $faker->randomElement($array = array ('an','mois','trimestre')), 
        'turnover' => $faker->numberBetween($min = 500000, $max = 2000000), 
        'total_jobs' => $faker->numberBetween($min = 10, $max = 1000), 
        'total_investment' => $faker->numberBetween($min = 100000, $max = 2000000), 
        'strengths' => fakeJson('strengths', 1, 4, NULL), 
        'weaknesses' => fakeJson('weaknesses', 0, 4, NULL), 
        'financing_modes' => fakeJson(NULL, 0, 4, 'double'), 
        'investment_program' => fakeJson(NULL, 0, 6, 'double'), 
        'partnerships' => $faker->text($maxNbChars = 100), 
        'contacts' => $faker->text($maxNbChars = 100),
    ];
});
