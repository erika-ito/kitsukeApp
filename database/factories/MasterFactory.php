<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Master;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Master::class, function (Faker $faker) {
    return [
        'rank' => $faker->numberBetween(0, 5),
        'name' => $faker->name,
        'furigana' => $faker->kanaName,
        'zip_code' => $faker->postcode1.'-'.$faker->postcode2,
        'address' => substr($faker->address, 9),
        'home_phone' => $faker->phoneNumber,
        'cell_phone' => $faker->phoneNumber,
        'mail' => $faker->safeEmail,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});
