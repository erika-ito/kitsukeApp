<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MastersTableSeeder::class);
        // $this->call(ConnectorsTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(ReservationsTableSeeder::class);

        // 中間テーブル
        $this->call(MasterReservationTableSeeder::class);
        $this->call(CustomerReservationTableSeeder::class);
    }
}
