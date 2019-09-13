<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Master;
use Faker\Generator as Faker;

$factory->define(Master::class, function (Faker $faker) {
    return [
        'rank' => $faker->numberBetween(0, 5),
        'name' => $faker->lastName.$faker->firstNameFeMale,
        'furigana' => mb_convert_kana($faker->lastKanaName.$faker->firstKanaNameFemale, 'c'),
        'zip_code' => $faker->postcode1.'-'.$faker->postcode2,
        'address' => substr($faker->address, 9),
        'home_phone' => $faker->phoneNumber,
        'cell_phone' => $faker->phoneNumber,
        'mail' => $faker->safeEmail,
    ];
});
