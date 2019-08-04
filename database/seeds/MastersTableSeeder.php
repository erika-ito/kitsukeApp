<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MastersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ranks = ['1','2','3','4','5'];

        foreach ($ranks as $rank) {
            DB::table('masters')->insert([
                'rank' => $rank,
                'name' => '山田花子',
                'furigana' => 'やまだはなこ',
                'zip_code' => '111-1111',
                'address' => '東京都新宿区111-111',
                'home_phone' => '03-0000-0000',
                'mail' => 'abc@gmail.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
