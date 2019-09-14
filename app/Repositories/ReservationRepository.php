<?php

namespace App\Libs;

class ReservationRepository
{
    // 顧客テーブルの登録・更新
    public static function save($request, $reservation, $match_connector)
    {
        $reservation->fill($request->all());
        $match_connector->reservations()->save($reservation);

        // 保存した予約のIDを取得
        return $reservation->id;
    }
}