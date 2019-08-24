<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Connector;
use Faker\Generator as Faker;

$factory->define(Connector::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'furigana' => mb_convert_kana($faker->kanaName, 'c'),
        'zip_code' => $faker->postcode1.'-'.$faker->postcode2,
        'address' => substr($faker->address, 9),
        'mark' => $faker->realText(15),
        'home_phone' => $faker->phoneNumber,
        'cell_phone' => $faker->phoneNumber,
        'mail' => $faker->safeEmail,
        'connect_method' => $faker->numberBetween(1, 3),
        'is_student' => $faker->numberBetween(1, 2),
        'total_count' => $faker->numberBetween(1, 20),
        'current_use_date' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'special' => $faker->realText(50),
    ];
});
