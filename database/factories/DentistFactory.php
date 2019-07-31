<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dentist;
use Faker\Generator as Faker;

$factory->define(Dentist::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
