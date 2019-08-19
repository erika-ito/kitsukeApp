<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Reservation;
use App\Connector;
use App\Customer;
use App\Master;
// use App\CustomerReservation;
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
        // $customer_reservation = new CustomerReservation();

        //　予約テーブル登録のカラムを限定
        // $columns = [
        //     'status',
        //     'user',
        //     'reservation_date',
        //     'reservation_type',
        //     'reply',
        //     'location_type',
        //     'location_date',
        //     'finish_time',
        //     'start_time',
        //     'count_person',
        //     'count_master',
        //     'purpose',
        // ];

        // 連絡者テーブル必須項目
        $match_connector = Connector::where('name', $request->name)
            ->orwhere('furigana', $request->furigana)->first();
        
        if (empty($match_connector)) {
            // 連絡者登録がない場合、新規登録する
            $connector->name = $request->name;
            $connector->furigana = $request->furigana;
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
            $match_connector->customers()->save($customer);

            // 予約にidが必要なため、再度検索
            $match_customer_1 = Customer::where('name', $request->name_1)
                ->orwhere('furigana', $request->furigana_1)->first();
        }

        // 予約テーブル必須項目
        $reservation->status = $request->status;
        $reservation->user = $request->user;
        $reservation->reservation_date = $request->reservation_date;
        $reservation->reservation_type = $request->reservation_type;
        $reservation->reply = $request->reply;
        $reservation->location_type = $request->location_type;
        $reservation->location_date = $request->location_date;
        $reservation->finish_time = $request->finish_time;
        $reservation->start_time = $request->start_time;
        $reservation->count_person = $request->count_person;
        $reservation->count_master = $request->count_master;
        $reservation->purpose = $request->purpose;

        // 他予約テーブル項目
        $reservation->tool_connect_date = $request->tool_connect_date;
        $reservation->tool_confirm_date = $request->tool_confirm_date;
        $reservation->master_request_date = $request->master_request_date;
        $reservation->tool_pass_date = $request->tool_pass_date;
        
        $match_connector->reservations()->save($reservation);

        // $reservation->fill($request->only($columns));

        // 中間テーブル項目（担当講師）
        $master_reservation_1 = Master::where('name', $request->master_name_1)->first();
        $reservation->masters()->attach($master_reservation_1);

        // 中間テーブル項目（着付対象者）
        // 顧客テーブル作成時の$match_customer_1を利用
        // $customer_reservation = [$match_customer_1, $request->kimono_type_1, $request->obi_type_1, $request->obi_knot_1];
        $reservation->customers()->attach($match_customer_1);

        // $customer_reservation->connector_id = $match_connector->id;
        // $customer_reservation->kimono_type = $request->kimono_type_1;
        // $customer_reservation->obi_type = $request->obi_type_1;
        // $customer_reservation->obi_knot = $request->obi_knot_1;

        // $customer_reservation->save();

        return redirect()->route('reservations.index');
    }
}
