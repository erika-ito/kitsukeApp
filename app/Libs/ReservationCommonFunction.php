<?php

namespace App\Libs;

use App\Reservation;

class ReservationCommonFunction
{
    // 顧客テーブルの登録・更新
    public static function save($request, $reservation, $match_connector)
    {
        // 予約テーブルの対象カラムを限定
        $reservation_columns = [
            // 予約テーブル必須項目
            'status',
            'user',
            'reservation_date',
            'reservation_type',
            'reply',
            'location_type',
            'location_date',
            'finish_time',
            'start_time',
            'count_person',
            'count_master',
            'purpose',

            // 初回任意項目
            'location_name',
            'location_zip_code',
            'location_address',
            'location_phone',
            'distance',
            'tool_buying',
            'total_price',
            'tool_connect_date',
            'tool_confirm_date',
            'master_request_date',
            'tool_pass_date',
            'payment',
            'thoughts',
            'notes',
        ];

        $reservation->fill($request->only($reservation_columns));
        $match_connector->reservations()->save($reservation);

        // 保存した予約のIDを取得
        return $reservation->id;
    }
}