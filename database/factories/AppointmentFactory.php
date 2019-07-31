<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Appointment;
use Faker\Generator as Faker;

$factory->define(Appointment::class, function (Faker $faker) {
    return [
        'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'price' => $faker->numberBetween($min = 10000, $max = 150000),
        'dentist_id' => $faker->numberBetween($min = 1, $max = 10),
        'service_id' => $faker->numberBetween($min = 1, $max = 10),
        'patient_id' => $faker->numberBetween($min = 1, $max = 10),
        
    ];
});
