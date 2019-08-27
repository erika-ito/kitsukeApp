<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Reservation;
use App\Connector;
use App\Customer;
use App\Master;
use App\CustomerReservation;
use Illuminate\Http\Request;
use App\Http\Requests\CreateReservationRequest;

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
        $connector = "";
        
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
    public function create(CreateReservationRequest $request)
    {
        $reservation = new Reservation();

        // 連絡者テーブル必須項目
        $match_connector = Connector::where('name', $request->name)
            ->orwhere('furigana', $request->furigana)->first();
        
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

            $connector = new Connector();
            $connector->fill($request->only($connector_columns));
            $connector->total_count = 1; // 初回
            $connector->current_use_date = $request->location_date;
            $connector->save();

            // 予約にリレーションを使用するため、再度検索
            $match_connector = Connector::where('name', $request->name)
                ->orwhere('furigana', $request->furigana)->first();
        } else {
            // 連絡者登録がある場合、利用回数と直近利用日を更新する
            $match_connector->total_count += 1; // 利用回数に+1
            $match_connector->current_use_date = $request->location_date;
            $match_connector->save();
        }

        // 顧客テーブルの登録・更新
        // 顧客データの個数をカウント
        for ($i = 1; $i <= 3; $i++) {
            if ($request->filled('name_'.$i)) {
                $customer_names[] = 'name_'.$i;
            }
        }
        $customer_counts = count($customer_names);

        // 顧客人数分繰り返し
        for ($i = 1; $i <= $customer_counts; $i++) {
            $match_customer = Customer::where('name', $request->input('name_'.$i))
                ->orwhere('furigana', $request->input('furigana_'.$i))->first();
            
            if (empty($match_customer)) {
                // 顧客データがない場合は新規登録
                $customer = new Customer();

                $customer->name = $request->input('name_'.$i);
                $customer->furigana = $request->input('furigana_'.$i);
                $customer->age = $request->input('age_'.$i);
                $customer->height = $request->input('height_'.$i);
                $customer->body_type = $request->input('body_type_'.$i);

                $match_connector->customers()->save($customer);

                // 中間テーブル（着付対象者）登録に必要なため、customer_idを保存
                ${'match_customer_'.$i.'_id'} = $customer->id;

            } else {
                // 顧客データがある場合は更新する
                $match_customer->name = $request->input('name_'.$i);
                $match_customer->furigana = $request->input('furigana_'.$i);
                $match_customer->age = $request->input('age_'.$i);
                $match_customer->height = $request->input('height_'.$i);
                $match_customer->body_type = $request->input('body_type_'.$i);

                $match_connector->customers()->save($match_customer);

                // 中間テーブル（着付対象者）登録に必要なため、customer_idを保存
                ${'match_customer_'.$i.'_id'} = $match_customer->id;
            }
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
        $master_names = "";
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

        // 担当講師がいる場合、IDを紐づけ
        if ($master_counts >= 1) {
            for ($i = 1; $i <= $master_counts; $i++) {
                ${'master_reservation_'.$i} = Master::where('name', $request->input('master_'.$i))->first();
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
}
