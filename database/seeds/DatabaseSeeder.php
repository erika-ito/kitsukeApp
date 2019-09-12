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
        $this->call(CustomersTableSeeder::class); // 連絡者データも顧客ファクトリー内で作成
        $this->call(ReservationsTableSeeder::class);

        // 中間テーブル
        $this->call(MasterReservationTableSeeder::class);
        $this->call(CustomerReservationTableSeeder::class);
    }
}
