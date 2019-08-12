<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConnectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('connectors')->insert([
            [
                'name' => '伊藤絵里香',
                'furigana' => 'いとうえりか',
                'zip_code' => '111-1111',
                'address' => '東京都新宿区1-1-1',
                'mark' => '7階建て。1階がコンビニ。',
                'home_phone' => '03-1111-1111',
                'cell_phone' => '090-1111-1111',
                'mail' => 'abc@gmail.com',
                'connect_method' => '1',
                'is_student' => '1',
                'total_count' => '1',
                'current_use_date' => '2019/4/1',
            ],
        ]);
    }
}
