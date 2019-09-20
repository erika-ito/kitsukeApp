<?php

namespace App\Services;

use DB;
use App\Master;
use App\Reservation;
use App\Repositories\ConnectorRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\ReservationRepository;
use App\Repositories\CustomerReservationRepository;

class ReservationService {

    private $connector_repository;
    private $customer_repository;
    private $reservation_repository;
    private $customer_reservation_repository;

    public function __construct(ConnectorRepository $connector_repository, CustomerRepository $customer_repository,
        ReservationRepository $reservation_repository, CustomerReservationRepository $customer_reservation_repository)
    {
        $this->connector_repository = $connector_repository;
        $this->customer_repository = $customer_repository;
        $this->reservation_repository = $reservation_repository;
        $this->customer_reservation_repository = $customer_reservation_repository;
    }
    
    // 予約の新規登録
    public function create($request)
    {
        DB::transaction(function() use($request) {
            $reservation = new Reservation();

            // 連絡者の検索と登録・更新
            $match_connector = $this->connector_repository->create($request);

            // 顧客の登録
            $customer_id_list = $this->saveCustomer($request, $match_connector);
            // 予約テーブル登録
            $insert_reservation_id = $this->saveReservation($request, $reservation, $match_connector);
        
            // 担当講師（中間テーブル）の登録
            $master_counts = $this->countMaster($request);
            // 担当講師がいる場合、予約IDを紐づけ
            if ($master_counts >= 1) {
                for ($i = 1; $i <= $master_counts; $i++) {
                    ${'master_reservation_'.$i} = Master::matchMasterName($request, $i)->first();
                    $reservation->masters()->attach(${'master_reservation_'.$i}->id);
                }
            }
            
            // 着付対象者（中間テーブル）の登録
            $this->customer_reservation_repository->save($request, $insert_reservation_id, $customer_id_list);
        });
    }

    // 予約の編集
    public function edit($request, $id)
    {
        DB::transaction(function() use($request, $id) {
            $reservation = Reservation::find($id);

            // 連絡者の検索と登録・更新
            $match_connector = $this->connector_repository->edit($request);

            // 顧客の登録
            $customer_id_list = $this->saveCustomer($request, $match_connector);
            // 予約テーブル登録
            $insert_reservation_id = $this->saveReservation($request, $reservation, $match_connector);
        
            // 担当講師（中間テーブル）の登録
            $master_counts = $this->countMaster($request);
            // 担当講師がいる場合、予約IDを紐づけ
            if ($master_counts >= 1) {
                // 予約IDに紐づいた講師データを一度削除
                $reservation->masters()->detach();

                // 予約IDと講師データを再度紐づけ
                for ($i = 1; $i <= $master_counts; $i++) {
                    ${'master_reservation_'.$i} = Master::matchMasterName($request, $i)->first();
                    $reservation->masters()->attach(${'master_reservation_'.$i}->id);
                }
            }

            // 着付対象者（中間テーブル）の更新
            // 予約IDに紐づいた顧客データを一度削除
            $reservation->customers()->detach();
            // 予約IDと顧客データを再度紐づけ
            $this->customer_reservation_repository->save($request, $insert_reservation_id, $customer_id_list);

            // 予約詳細画面へリダイレクトするため、インスタンスを返却
            return $reservation;
        });
    }

    // 顧客の登録部分
    public function saveCustomer($request, $match_connector)
    {
        // 顧客の人数をカウント
        $customer_name_list = [];
        for ($i = 1; $i <= 3; $i++) {
            if ($request->filled('name_'.$i)) {
                $customer_name_list[] = 'name_'.$i;
            }
        }
        $customer_counts = count($customer_name_list);

        // 人数分の顧客データを登録
        $customer_id_list = [];
        for ($i = 1; $i <= $customer_counts; $i++) {
            // 顧客IDを配列に格納
            $customer_id_list[] = $this->customer_repository->save($request, $i, $match_connector);
        }

        // 中間テーブル（着付対象者）登録に必要なため、顧客IDのリストを返却
        return $customer_id_list;
    }

    // 予約テーブル登録部分
    public function saveReservation($request, $reservation, $match_connector)
    {
        // 予約テーブル登録
        $this->reservation_repository->save($request, $reservation, $match_connector);
        
        // 中間テーブル（着付対象者）登録に必要なため、保存した予約のIDを返却
        return $reservation->id;
    }

    // 担当講師のカウント部分
    public function countMaster($request)
    {
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

        return $master_counts;
    }
}