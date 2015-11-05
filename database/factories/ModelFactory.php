<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(NpTS\Domain\Client\Models\User::class, function (Faker\Generator $faker) {
    $faker->locale('pt_BR');
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt('senha'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(NpTS\Domain\HelpDesk\Models\Question::class , function(Faker\Generator $faker){
    $faker->locale('pt_BR');
    return [
       'title' => $faker->sentence(),
       'body'   => $faker->paragraph
   ];
});
