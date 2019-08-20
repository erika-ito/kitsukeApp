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
    public function showCreateForm()
    {
        $today = Carbon::today();
        $formatted_today = $today->format('Y-m-d');
        
        return view('reservations.create',[
            'today' => $formatted_today,
        ]);
    }

    // 新規登録処理
    public function create(Request $request)
    {
        $reservation = new Reservation();
        $connector = new Connector();
        $customer = new Customer();
        $customer_reservation = new CustomerReservation();

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
                'special',
            ];

            $connector->fill($request->only($connector_columns));
            $connector->total_count = 1; // 仮
            $connector->current_use_date = $request->location_date;
            $connector->save();

            // 予約にidが必要なため、再度検索
            $match_connector = Connector::where('name', $request->name)
                ->orwhere('furigana', $request->furigana)->first();
        } 

        // 顧客テーブル必須項目
        $match_customer_1 = Customer::where('name', $request->name_1)
            ->orwhere('furigana', $request->furigana_1)->first();

        if (empty($match_customer_1)) {
            // 顧客登録がない場合
            $customer->name = $request->name_1;
            $customer->furigana = $request->furigana_1;
            $customer->age = $request->age_1;
            $customer->height = $request->height_1;
            $customer->body_type = $request->body_type_1;
            $match_connector->customers()->save($customer);

            // 予約にidが必要なため、再度検索
            $match_customer_1 = Customer::where('name', $request->name_1)
                ->orwhere('furigana', $request->furigana_1)->first();
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

            // 他項目
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

        // 中間テーブル項目（担当講師）
        $master_reservation_1 = Master::where('name', $request->master_name_1)->first();
        if (! empty($master_reservation_1)) {
            // 担当講師がいる場合、IDを紐づけ
            $reservation->masters()->attach($master_reservation_1->id);
        }

        // 中間テーブル項目（着付対象者）
        // 顧客テーブル作成時の$match_customer_1を利用
        // $customer_reservation = [$match_customer_1->id, $request->kimono_type_1, $request->obi_type_1, $request->obi_knot_1];
        $reservation->customers()->attach($match_customer_1->id);
        // $reservation->customers()->attach($request->kimono_type_1);

        // $customer_reservation->customer_id = $match_customer_1->id;
        // $customer_reservation->kimono_type = $request->kimono_type_1;
        // $customer_reservation->obi_type = $request->obi_type_1;
        // $customer_reservation->obi_knot = $request->obi_knot_1;

        // $customer_reservation->save();

        return redirect()->route('reservations.index');
    }
}
