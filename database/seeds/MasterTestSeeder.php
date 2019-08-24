<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('masters')->insert([
            [
                'rank' => '5',
                'name' => '石橋',
                'furigana' => 'いしばし',
                'zip_code' => '111-1111',
                'address' => '東京都新宿区111-111',
                'home_phone' => '03-0000-0000',
                'mail' => 'abc@gmail.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'rank' => '5',
                'name' => '石井',
                'furigana' => 'いしい',
                'zip_code' => '111-1111',
                'address' => '東京都新宿区111-111',
                'home_phone' => '03-0000-0000',
                'mail' => 'abc@gmail.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'rank' => '5',
                'name' => '伊藤',
                'furigana' => 'いとう',
                'zip_code' => '111-1111',
                'address' => '東京都新宿区111-111',
                'home_phone' => '03-0000-0000',
                'mail' => 'abc@gmail.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
        
    }
}
