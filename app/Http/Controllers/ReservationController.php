<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Connector;
use App\Customer;
use App\Master;
use App\Reservation;
use App\CustomerReservation;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Facades\ReservationFacade;
use App\Libs\CustomerCommonFunction;

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
    public function create(ReservationRequest $request)
    {
        // $facade = new ReservationFacade();
        // $facade->save($request->getParams());
        $reservation = new Reservation();

        // 連絡者テーブルの登録・更新
        // 連絡者の検索
        $match_connector = Connector::matchConnectorName($request)->first();
        
        if (empty($match_connector)) {
            // 連絡者登録がない場合、新規登録する
            //　連絡者テーブルの対象カラムを限定
            $connector_columns = [
                'name',
                'furigana',
                'zip_code',
                'address',
                'mark',
                'home_phone',
                'cell_phone',
                'mail',
                'connect_method',
                'is_student',
            ];

            $match_connector = new Connector();
            $match_connector->fill($request->only($connector_columns));
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
        $customer_names = [];
        for ($i = 1; $i <= 3; $i++) {
            if ($request->filled('name_'.$i)) {
                $customer_names[] = 'name_'.$i;
            }
        }
        $customer_counts = count($customer_names);

        // 人数分の顧客データを保存
        for ($i = 1; $i <= $customer_counts; $i++) {
            // 中間テーブル（着付対象者）登録に必要なため、customer_idを格納
            ${'match_customer_'.$i.'_id'} = CustomerCommonFunction::saveCustomer($request, $i, $match_connector);
        }

        // 予約テーブル登録
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
        $insert_reservation_id = $reservation->id;

        // 中間テーブル（担当講師）への保存
        // 担当講師データの個数をカウント
        $master_names = [];
        for ($i = 1; $i <= 4; $i++) {
            if ($request->filled('master_'.$i)) {
                $master_names[] = 'master_'.$i;
            }
        }

        if (is_array($master_names)) {
            $master_counts = count($master_names);
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
        for ($i = 1; $i <= $customer_counts; $i++) {
            $customer_reservation = new CustomerReservation();

            $customer_reservation->reservation_id = $insert_reservation_id;
            $customer_reservation->customer_id = ${'match_customer_'.$i.'_id'};  // 顧客テーブル作成時の${'match_customer_'.$i.'_id'}を利用
            $customer_reservation->kimono_type = $request->input('kimono_type_'.$i);
            $customer_reservation->obi_type = $request->input('obi_type_'.$i);
            $customer_reservation->obi_knot = $request->input('obi_knot_'.$i);
    
            $customer_reservation->save();    
        }

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
    public function edit(ReservationRequest $request, int $id)
    {
        $reservation = Reservation::find($id);

        // 連絡者テーブルの更新
        // 連絡者の検索
        $match_connector = Connector::matchConnectorName($request)->first();
        
        //　連絡者テーブルの対象カラムを限定
        $connector_columns = [
            'name',
            'furigana',
            'zip_code',
            'address',
            'mark',
            'home_phone',
            'cell_phone',
            'mail',
            'connect_method',
            'is_student',
        ];

        $match_connector->fill($request->only($connector_columns));
        $match_connector->save();

        // 顧客テーブルの登録・更新
        // 顧客データの個数をカウント
        $customer_names = [];
        for ($i = 1; $i <= 3; $i++) {
            if ($request->filled('name_'.$i)) {
                $customer_names[] = 'name_'.$i;
            }
        }
        $customer_counts = count($customer_names);

        // 人数分の顧客データを更新
        for ($i = 1; $i <= $customer_counts; $i++) {
            // 中間テーブル（着付対象者）登録に必要なため、customer_idを格納
            ${'match_customer_'.$i.'_id'} = CustomerCommonFunction::saveCustomer($request, $i, $match_connector);
        }

        // 予約テーブルの編集
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
        $insert_reservation_id = $reservation->id;

        // 中間テーブル（担当講師）への保存・更新
        // 担当講師データの個数をカウント
        $master_names = [];
        for ($i = 1; $i <= 4; $i++) {
            if ($request->filled('master_'.$i)) {
                $master_names[] = 'master_'.$i;
            }
        }

        if (is_array($master_names)) {
            $master_counts = count($master_names);
        } else {
            $master_counts = 0;
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
        for ($i = 1; $i <= $customer_counts; $i++) {
            $customer_reservation = new CustomerReservation();

            $customer_reservation->reservation_id = $insert_reservation_id;
            $customer_reservation->customer_id = ${'match_customer_'.$i.'_id'};  // 顧客テーブル作成時の${'match_customer_'.$i.'_id'}を利用
            $customer_reservation->kimono_type = $request->input('kimono_type_'.$i);
            $customer_reservation->obi_type = $request->input('obi_type_'.$i);
            $customer_reservation->obi_knot = $request->input('obi_knot_'.$i);
    
            $customer_reservation->save();    
        }

        return redirect()->route('reservations.show', [
            'reservation' => $reservation,
            'id' => $id,
        ]);
    }
    
}
