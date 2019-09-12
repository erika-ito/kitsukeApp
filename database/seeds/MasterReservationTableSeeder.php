<?php

use App\Master;
use App\Reservation;
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
        // 予約の総数
        $reservation_count = Reservation::all()->count();

        for ($i = 1; $i <= $reservation_count; $i++) {
            DB::table('master_reservation')->insert([
                'reservation_id' => $i,
                'master_id' => Master::all()->random()->id,
            ]);
        }
    }
}
