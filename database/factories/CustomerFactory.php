<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use App\Connector;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'connector_id' => function() {
            return factory(Connector::class)->create()->id;
        },
        'name' => $faker->lastName.$faker->firstNameFeMale,
        'furigana' => mb_convert_kana($faker->lastKanaName.$faker->firstKanaNameFemale, 'c'),
        'age' => $faker->numberBetween(20, 60),
        'height' => $faker->numberBetween(150, 170),
        'body_type' => $faker->numberBetween(1, 3),
    ];
});
