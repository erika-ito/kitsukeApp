<?php

namespace App\Services;

use App\Master;
use App\Reservation;
use App\Http\Requests\ReservationRequest;
use App\Repositories\ConnectorRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\ReservationRepository;
use App\Repositories\CustomerReservationRepository;

class ReservationService {
    public function save(ReservationRequest $request, ConnectorRepository $connector_repository,
        CustomerRepository $customer_repository, ReservationRepository $reservation_repository, CustomerReservationRepository $customer_reservation_repository)
    {
        $reservation = new Reservation();

        // 連絡者テーブルの検索、登録・更新
        // 他テーブルに紐づけるため、連絡者を格納
        $match_connector = $connector_repository->create($request);

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
            $customer_id_list[] = $customer_repository->save($request, $i, $match_connector);
        }
        
        // 予約テーブル登録
        // 中間テーブル登録に必要なため、reservation_idを格納
        $insert_reservation_id = $reservation_repository->save($request, $reservation, $match_connector);
        
        // 中間テーブル（担当講師）への保存
        // 担当講師データの個数をカウント
        $master_name_list = [];
        for ($i = 1; $i <= 4; $i++) {
            if ($request->filled('master_'.$i)) {
                $master_name_list[] = 'master_'.$i;
            }
        }

        $master_counts = 0;
        if (is_array($master_name_list)) {
            $master_counts = count($master_name_list);
        }

        // 担当講師がいる場合、予約IDを紐づけ
        if ($master_counts >= 1) {
            for ($i = 1; $i <= $master_counts; $i++) {
                ${'master_reservation_'.$i} = Master::matchMasterName($request, $i)->first();
                $reservation->masters()->attach(${'master_reservation_'.$i}->id);
            }
        }
        
        // 中間テーブル（着付対象者）への保存
        $customer_reservation_repository->save($request, $insert_reservation_id, $customer_id_list);
    }
}