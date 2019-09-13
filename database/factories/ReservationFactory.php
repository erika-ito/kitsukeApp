<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reservation;
use App\Connector;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) {
    // randomElementの配列
    $status = [1, 2, 3, 4, 7]; // 仮予約～予約確定までとキャンセル
    $finish_time = ['10:00', '11:00'];
    $start_time =  ['8:00', '9:00'];
    $purpose = ['結婚式', 'パーティ', '観劇'];
    $distance = ['新宿駅から徒歩5分', '渋谷駅から徒歩5分', '池袋駅から徒歩5分'];
    $total_price = [7560, 8640, 9720];
    
    return [
        'connector_id' => function() {
            return Connector::all()->random()->id;
        },
        'status' => $faker->randomElement($status),
        'user' => $faker->lastName,
        'reservation_date' => $faker->date,
        'reservation_type' => $faker->numberBetween(1, 3),
        'reply' => $faker->numberBetween(1, 2),
        'location_type' => $faker->numberBetween(1, 5), // その他（出張場所）は除外
        'location_date' => $faker->dateTimeBetween($startDate = '+6 months', $endDate = '+1 years'),
        'finish_time' => $faker->randomElement($finish_time),
        'start_time' => $faker->randomElement($start_time),
        'count_person' => '1',
        'count_master' => '1',
        'purpose' => $faker->randomElement($purpose),
        'distance' => $faker->randomElement($distance),
        'tool_buying' => $faker->numberBetween(1, 4),
        'total_price' => $faker->randomElement($total_price),
        'tool_connect_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+6 months'),
        'tool_confirm_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+6 months'),
        'master_request_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+6 months'),
        'tool_pass_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+6 months'),
        'notes' => $faker->realText(50),
    ];
});
