<?php

namespace App\Repositories;

class ReservationRepository
{
    // 顧客テーブルの登録・更新
    public function save($request, $reservation, $match_connector)
    {
        $reservation->fill($request->all());
        $match_connector->reservations()->save($reservation);
    }
}