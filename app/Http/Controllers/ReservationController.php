<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Connector;
use App\Master;
use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Facades\ReservationFacade;
use App\Repositories\ConnectorRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\ReservationRepository;
use App\Repositories\CustomerReservationRepository;

class ReservationController extends Controller
{
    // 一覧表示（検索あり）
    public function index(Request $request)
    {
        $keyword = str_replace('/', '-', $request->keyword);

        //　一覧表示のカラムを限定
        $columns = [
            'reservations.id', //　検索時にidが複数あるため明示化
            'status',
            'location_date',
            'start_time',
            'finish_time',
            'connector_id',
            'count_person',
        ];

        // 検索、並び替え、ページネーション
        $reservations = Reservation::keyword($keyword)
            ->orderBy('location_date','asc')
            ->orderBy('start_time','asc')
            ->paginate(5, $columns);

        // 予約一覧へ
        return view('reservations.index', [
            'reservations' => $reservations,
            'keyword' => $keyword,
        ]);
    }

    // 詳細表示
    public function show(int $id)
    {
        $reservation = Reservation::find($id);
        
        return view('reservations.show', [
            'reservation' => $reservation,
            'id' => $id,
        ]);
    }

    // 新規登録フォーム表示
    public function showCreateForm(int $connector_id = null)
    {
        $connector = null;
        
        // 再予約ボタンから登録する場合
        if (! empty($connector_id)) {
            $connector = Connector::find($connector_id);
        }
        
        $today = Carbon::today();
        $formatted_today = $today->format('Y-m-d');
        
        return view('reservations.create',[
            'today' => $formatted_today,
            'connector' => $connector,
        ]);
    }

    // 新規登録処理
    public function create(ReservationRequest $request, ReservationFacade $facade)
    {
        $facade->save($request->getParams());
        
        // $reservation = new Reservation();

        // // 連絡者テーブルの検索、登録・更新
        // // 他テーブルに紐づけるため、連絡者を格納
        // $match_connector = $connector_repository->create($request);

        // // 顧客テーブルの登録・更新
        // // 顧客データの個数をカウント
        // $customer_name_list = [];
        // for ($i = 1; $i <= 3; $i++) {
        //     if ($request->filled('name_'.$i)) {
        //         $customer_name_list[] = 'name_'.$i;
        //     }
        // }
        // $customer_counts = count($customer_name_list);

        // // 人数分の顧客データを保存
        // $customer_id_list = [];
        // for ($i = 1; $i <= $customer_counts; $i++) {
        //     // 中間テーブル（着付対象者）登録に必要なため、customer_idを配列に格納
        //     $customer_id_list[] = $customer_repository->save($request, $i, $match_connector);
        // }
        
        // // 予約テーブル登録
        // // 中間テーブル登録に必要なため、reservation_idを格納
        // $insert_reservation_id = $reservation_repository->save($request, $reservation, $match_connector);
        
        // // 中間テーブル（担当講師）への保存
        // // 担当講師データの個数をカウント
        // $master_name_list = [];
        // for ($i = 1; $i <= 4; $i++) {
        //     if ($request->filled('master_'.$i)) {
        //         $master_name_list[] = 'master_'.$i;
        //     }
        // }

        // $master_counts = 0;
        // if (is_array($master_name_list)) {
        //     $master_counts = count($master_name_list);
        // }

        // // 担当講師がいる場合、予約IDを紐づけ
        // if ($master_counts >= 1) {
        //     for ($i = 1; $i <= $master_counts; $i++) {
        //         ${'master_reservation_'.$i} = Master::matchMasterName($request, $i)->first();
        //         $reservation->masters()->attach(${'master_reservation_'.$i}->id);
        //     }
        // }
        
        // // 中間テーブル（着付対象者）への保存
        // $customer_reservation_repository->save($request, $insert_reservation_id, $customer_id_list);

        return redirect()->route('reservations.index');
    }

    // 編集フォーム表示
    public function showEditForm(int $id)
    {
        $reservation = Reservation::find($id);
        $connector = $reservation->connector()->first();

        // 担当講師を取得
        $masters = $reservation->masters()->get();

        $master_1 = null;
        $master_2 = null;
        $master_3 = null;
        $master_4 = null;

        $i = 1;
        foreach ($masters as $master) {
            ${'master_'.$i} = $master;
            $i++;
        }

        // 着付対象者を取得
        $customers = $reservation->customers()->get();

        $customer_1 = null;
        $customer_2 = null;
        $customer_3 = null;

        $i = 1;
        foreach ($customers as $customer) {
            ${'customer_'.$i} = $customer;
            $i++;
        }

        return view('reservations.edit', [
            'reservation' => $reservation,
            'connector' => $connector,
            'master_1' => $master_1,
            'master_2' => $master_2,
            'master_3' => $master_3,
            'master_4' => $master_4,
            'customer_1' => $customer_1,
            'customer_2' => $customer_2,
            'customer_3' => $customer_3,
        ]);
    }
    
    // 編集処理
    public function edit(ReservationRequest $request, int $id, ConnectorRepository $connector_repository,
        CustomerRepository $customer_repository, ReservationRepository $reservation_repository, CustomerReservationRepository $customer_reservation_repository)
    {
        $reservation = Reservation::find($id);

        // 連絡者テーブルの検索、更新
        // 他テーブルに紐づけるため、連絡者を格納
        $match_connector = $connector_repository->edit($request);

        // 顧客テーブルの登録・更新
        // 顧客データの個数をカウント
        $customer_name_list = [];
        for ($i = 1; $i <= 3; $i++) {
            if ($request->filled('name_'.$i)) {
                $customer_name_list[] = 'name_'.$i;
            }
        }
        $customer_counts = count($customer_name_list);

        // 人数分の顧客データを更新
        $customer_id_list = [];
        for ($i = 1; $i <= $customer_counts; $i++) {
            // 中間テーブル（着付対象者）登録に必要なため、customer_idを配列に格納
            $customer_id_list[] = $customer_repository->save($request, $i, $match_connector);
        }

        // 予約テーブルの編集
        // 中間テーブル登録に必要なため、reservation_idを格納
        $insert_reservation_id = $reservation_repository->save($request, $reservation, $match_connector);

        // 中間テーブル（担当講師）への保存・更新
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
            // 予約IDに紐づいた講師データを一度削除
            $reservation->masters()->detach();

            // 予約IDと講師データを再度紐づけ
            for ($i = 1; $i <= $master_counts; $i++) {
                ${'master_reservation_'.$i} = Master::matchMasterName($request, $i)->first();
                $reservation->masters()->attach(${'master_reservation_'.$i}->id);
            }
        }

        // 中間テーブル（着付対象者）への保存・更新
        // 予約IDに紐づいた顧客データを一度削除
        $reservation->customers()->detach();

        // 予約IDと顧客データを再度紐づけ
        $customer_reservation_repository->save($request, $insert_reservation_id, $customer_id_list);

        return redirect()->route('reservations.show', [
            'reservation' => $reservation,
            'id' => $id,
        ]);
    }
}
