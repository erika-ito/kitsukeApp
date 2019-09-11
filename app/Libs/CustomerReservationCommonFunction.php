<?php

namespace App\Libs;

use App\CustomerReservation;

class CustomerReservationCommonFunction
{
    // 顧客テーブルの登録・更新
    public static function save($request, $i, $insert_reservation_id, ${'match_customer_'.$i.'_id'})
    {
        // 中間テーブル（着付対象者）への保存
        $customer_reservation = new CustomerReservation();

        $customer_reservation->reservation_id = $insert_reservation_id;
        $customer_reservation->customer_id = ${'match_customer_'.$i.'_id'};  // 顧客テーブル作成時の${'match_customer_'.$i.'_id'}を利用
        $customer_reservation->kimono_type = $request->input('kimono_type_'.$i);
        $customer_reservation->obi_type = $request->input('obi_type_'.$i);
        $customer_reservation->obi_knot = $request->input('obi_knot_'.$i);

        $customer_reservation->save();
    }

}