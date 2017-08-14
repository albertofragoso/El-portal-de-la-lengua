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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'roll' => $faker->boolean(),
    ];
});

$factory->define(App\Articulo::class, function (Faker\Generator $faker) {

  return [
      'titulo' => $faker->words(5, true),
      'contenido' => $faker->realText(random_int(500, 1000)),
      'imagen' => $faker->imageUrl(600, 338),
      'created_at' => $faker->dateTimeThisDecade,
      'updated_at' => $faker->dateTimeThisDecade,
  ];
});


$factory->define(App\Message::class, function (Faker\Generator $faker) {

  return [
    'content' => $faker->realText(random_int(50, 100)),
    'created_at' => $faker->dateTimeThisYear,
    'updated_at' => $faker->dateTimeThisYear,
  ];
});
