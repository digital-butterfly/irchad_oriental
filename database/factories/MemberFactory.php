<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Member;
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

$factory->define(Member::class, function (Faker $faker) {
    return [
        'identity_number' => $faker->numberBetween($min = 2000, $max = 8000),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->unique()->e164PhoneNumber,
        'status' => $faker->randomElement($array = array ('En cours d\'examen','Validé','Rejeté')),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'remember_token' => Str::random(10),
        'gender' => $faker->randomElement($array = array ('Homme','Femme')),
        'birth_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'address' => $faker->address,
        'township_id' => $faker->randomElement($array = array (5,9,10,13)),
        'degrees' => fakeJson(NULL, 0, 3, 'double'),
        'professional_experience' => fakeJson(NULL, 1, 4, 'double'),
    ];
});
