<?php

use App\Customer;
use App\Reservation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerReservationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        // 予約の総数
        $reservation_count = Reservation::all()->count();

        for ($i = 1; $i <= $reservation_count; $i++) {
            DB::table('customer_reservation')->insert([
                'reservation_id' => $i,
                'customer_id' => Customer::all()->random()->id,
                'kimono_type' => $faker->numberBetween(4, 10), // 振袖から色無地まで
                'obi_type' => $faker->numberBetween(1, 3),
                'obi_knot' => $faker->numberBetween(1, 4),
            ]);
        }
    }
}
