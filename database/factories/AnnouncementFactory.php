<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Announcement;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(Announcement::class, function (Faker $faker) {
    return [
        'group_id' => $faker->unique()->numberBetween(1,10),
        'content' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
