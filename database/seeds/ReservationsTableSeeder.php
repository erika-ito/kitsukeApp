<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->insert([
            [
                'connector_id' => '1',
                'status' => '4', //　予約確定
                'user' => '佐藤',
                'reservation_date' => '2019/11/1',
                'reservation_type' => '1',
                'reply' => '1',
                'location_type' => '1',
                'location_date' => '2019/12/1',
                'finish_time' => '15:00',
                'start_time' => '13:00',
                'count_person' => '2',
                'count_master' => '1',
                'purpose' => '結婚式',
                'distance' => '新宿駅から徒歩5分',
                'tool_buying' => '1',
                'total_price' => '12960',
                'tool_connect_date' => '2019/11/1',
                'tool_confirm_date' => '2019/11/5',
                'master_request_date' => '2019/11/1',
                'tool_pass_date' => '2019/11/20',
                'notes' => '着物に不慣れな方のようです。',
            ],
            [
                'connector_id' => '2',
                'status' => '4', //　予約確定
                'user' => '佐藤',
                'reservation_date' => '2019/11/1',
                'reservation_type' => '1',
                'reply' => '1',
                'location_type' => '1',
                'location_date' => '2019/12/2',
                'finish_time' => '15:00',
                'start_time' => '14:00',
                'count_person' => '1',
                'count_master' => '1',
                'purpose' => '結婚式',
                'distance' => '新宿駅から徒歩5分',
                'tool_buying' => '1',
                'total_price' => '12960',
                'tool_connect_date' => '2019/11/1',
                'tool_confirm_date' => '2019/11/5',
                'master_request_date' => '2019/11/1',
                'tool_pass_date' => '2019/11/20',
                'notes' => '着物に不慣れな方のようです。',
            ],
        ]);
    }
}
