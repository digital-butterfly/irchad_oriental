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
        'member_id' => $faker->randomElement($array = array (12,14,15,18,19,20,21,23,24,25,26)),
        'category_id' => $faker->randomElement($array = array (12,13,14,17,18)),
        'township_id' => $faker->randomElement($array = array (5,9,10,13)),
        'sheet_id' => NULL,
        'title' => $faker->catchPhrase,
        'description' => $faker->text($maxNbChars = 100),
        'market_type' => $faker->randomElement($array = array ('Marché national','Export','Marché national et exportExl')),
        'business_model' => json_decode(json_encode([
            'core_business' => $faker->text($maxNbChars = 200),
            'primary_target' => $faker->text($maxNbChars = 200),
            'suppliers' => $faker->text($maxNbChars = 200),
            'competition' => $faker->text($maxNbChars = 200),
            'advertising' => $faker->text($maxNbChars = 200),
            'pricing_strategy' => $faker->text($maxNbChars = 200),
            'distribution_strategy' => $faker->text($maxNbChars = 200),
        ])),
        'financial_data' => json_decode(json_encode([
            'financial_plan' => json_decode(fakeJson(NULL, 2, 6, 'double')),
            'financial_plan_loans' => json_decode(fakeJson(NULL, 1, 3, 'quadruple')),
            'startup_needs' => json_decode(fakeJson(NULL, 2, 6, 'double')),
            'overheads_fixed' => json_decode(fakeJson(NULL, 2, 6, 'double')),
            'overheads_scalable' => json_decode(fakeJson(NULL, 2, 6, 'double')),
            'human_ressources' => json_decode(fakeJson(NULL, 2, 6, 'triple')),
            'taxes' => json_decode(fakeJson(NULL, 1, 3, 'double')),
            'services_turnover_forecast' => $faker->numberBetween($min = 200000, $max = 5000000),
            'products_turnover_forecast' => $faker->numberBetween($min = 200000, $max = 5000000),
            'profit_margin_rate' => $faker->numberBetween($min = 1, $max = 300),
            'evolution_rate' => $faker->numberBetween($min = 0, $max = 300),
        ])),
        'company' => json_decode(json_encode([
            'legal_form' => $faker->randomElement($array = array ('Association','Coopérative','SARL')),
            'is_created' => $faker->randomElement($array = array ('Oui','Non')),
            'capital' => $faker->optional()->numberBetween($min = 50000, $max = 10000000),
            'creation_date' => $faker->optional()->date($format = 'Y-m-d'),
            'corporate_name' => $faker->optional()->company,
        ])),
        'status' => $faker->randomElement($array = array ('Nouveau','Accepté','Rejeté','Incubé')),
        'created_by' => $faker->randomElement($array = array (25,26,27,28,29))
    ];
});
