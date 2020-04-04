<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProjectApplication;
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

$factory->define(ProjectApplication::class, function (Faker $faker) {
    return [
        'member_id' => $faker->randomElement($array = array (8,10,12,14,15,18,19,20,21,23,24,25,26)), 
        'category_id' => $faker->randomElement($array = array (12,13,14,17,18)), 
        'township_id' => $faker->randomElement($array = array (5,9,10,13)), 
        'sheet_id' => NULL, 
        'title' => $faker->catchPhrase, 
        'description' => $faker->text($maxNbChars = 100), 
        'business_model' => json_encode([
            'core_business' => $faker->text($maxNbChars = 100),
            'key_ressources' => $faker->text($maxNbChars = 100),
            'primary_target' => $faker->text($maxNbChars = 100),
            'cost_structure' => $faker->text($maxNbChars = 100),
            'income' => $faker->text($maxNbChars = 100),
        ]), 
        'financial_data' => json_encode([
            'financial_plan' => json_decode(fakeJson(NULL, 2, 6, 'double')),
            'startup_needs' => json_decode(fakeJson(NULL, 2, 6, 'double')),
            'overheads' => json_decode(fakeJson(NULL, 2, 6, 'double')),
            'human_ressources' => json_decode(fakeJson(NULL, 2, 6, 'triple')),
            'services_turnover_forecast' => $faker->numberBetween($min = 200000, $max = 5000000),
            'products_turnover_forecast' => $faker->numberBetween($min = 200000, $max = 5000000),
            'profit_margin_rate' => $faker->numberBetween($min = 1, $max = 300),
            'evolution_rate' => $faker->numberBetween($min = 0, $max = 300),
        ]), 
        'company' => json_encode([
            'legal_form' => $faker->randomElement($array = array ('Association','Coopérative','SARL')),
            'is_created' => '',
            'creation_date' => $faker->optional()->date($format = 'Y-m-d'),
            'corporate_name' => $faker->optional()->company,
        ]),
        'status' => $faker->randomElement($array = array ('Nouveau','Accepté','Rejeté','Incubé'))
    ];
});
