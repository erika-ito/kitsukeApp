<?php

namespace App\Services;

use App\Connector;
use App\Master;
use App\Reservation;
use App\Libs\ConnectorCommonFunction;
use App\Libs\CustomerCommonFunction;
use App\Libs\ReservationCommonFunction;
use App\Libs\CustomerReservationCommonFunction;

class ReservationService {
    public function save($request)
    {
        $reservation = new Reservation();

        // 連絡者テーブルの登録・更新
        // 連絡者の検索
        $match_connector = Connector::matchConnectorName($request)->first();
        
        if (empty($match_connector)) {
            // 連絡者登録がない場合、新規登録する
            $match_connector = new Connector();

            //　利用回数、直近利用日以外のカラム
            ConnectorCommonFunction::fill($request, $match_connector);
            //　利用回数、直近利用日
            $match_connector->total_count = 1; // 初回
            $match_connector->current_use_date = $request->location_date;
            
            $match_connector->save();

        } else {
            // 連絡者登録がある場合、利用回数と直近利用日を更新する
            $match_connector->total_count += 1; // 利用回数に+1
            $match_connector->current_use_date = $request->location_date;
            $match_connector->save();
        }

        // 顧客テーブルの登録・更新
        // 顧客データの個数をカウント
        $customer_name_list = [];
        for ($i = 1; $i <= 3; $i++) {
            if ($request->filled('name_'.$i)) {
                $customer_name_list[] = 'name_'.$i;
            }
        }
        $customer_counts = count($customer_name_list);

        // 人数分の顧客データを保存
        $customer_id_list = [];
        for ($i = 1; $i <= $customer_counts; $i++) {
            // 中間テーブル（着付対象者）登録に必要なため、customer_idを配列に格納
            $customer_id_list[] = CustomerCommonFunction::save($request, $i, $match_connector);
        }
        
        // 予約テーブル登録
        // 中間テーブル登録に必要なため、reservation_idを格納
        $insert_reservation_id = ReservationCommonFunction::save($request, $reservation, $match_connector);

        // 中間テーブル（担当講師）への保存
        // 担当講師データの個数をカウント
        $master_name_list = [];
        for ($i = 1; $i <= 4; $i++) {
            if ($request->filled('master_'.$i)) {
                $master_name_list[] = 'master_'.$i;
            }
        }

        if (is_array($master_name_list)) {
            $master_counts = count($master_name_list);
        } else {
            $master_counts = 0;
        }

        // 担当講師がいる場合、予約IDを紐づけ
        if ($master_counts >= 1) {
            for ($i = 1; $i <= $master_counts; $i++) {
                ${'master_reservation_'.$i} = Master::matchMasterName($request, $i)->first();
                $reservation->masters()->attach(${'master_reservation_'.$i}->id);
            }
        }
        
        // 中間テーブル（着付対象者）への保存
        CustomerReservationCommonFunction::save($request, $customer_counts, $insert_reservation_id, $customer_id_list);
    }
}