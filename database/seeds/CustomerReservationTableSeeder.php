<?php

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
        DB::table('customer_reservation')->insert([
            [
                'reservation_id' => '1',
                'customer_id' => '1',
                'kimono_type' => '8',
                'obi_type' => '1',
                'obi_knot' => '1',
            ],
        ]);
    }
}
