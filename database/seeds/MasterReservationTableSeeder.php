<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterReservationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_reservation')->insert([
            [
                'reservation_id' => '1',
                'master_id' => '1',
            ],
            [
                'reservation_id' => '2',
                'master_id' => '1',
            ],
        ]);
    }
}
