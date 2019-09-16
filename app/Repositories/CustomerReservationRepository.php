<?php

namespace App\Repositories;

use App\CustomerReservation;

class CustomerReservationRepository
{
    // 中間テーブル（着付対象者）への保存
    public static function save($request, $customer_counts, $insert_reservation_id, $customer_id_list)
    {
        for ($i = 1; $i <= $customer_counts; $i++) {
            $customer_reservation = new CustomerReservation();

            $customer_reservation->reservation_id = $insert_reservation_id;
            $customer_reservation->customer_id = $customer_id_list[$i-1]; // 配列からIDを取り出す
            $customer_reservation->kimono_type = $request->input('kimono_type_'.$i);
            $customer_reservation->obi_type = $request->input('obi_type_'.$i);
            $customer_reservation->obi_knot = $request->input('obi_knot_'.$i);

            $customer_reservation->save();
        }
    }
}