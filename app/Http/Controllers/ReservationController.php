<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Reservation;
use App\Connector;
use App\Customer;
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
            'id', 
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

        // $reservation->fill($request->except('name', 'furigana'));
        
        // 連絡者テーブル必須項目
        $match_connector = Connector::where('name', $request->name)->first();
        
        if (empty($match_connector)) {
            // 連絡者登録がない場合
            $connector->name = $request->name;
            $connector->furigana = $request->furigana;
            $connector->save();

            $match_connector = Connector::where('name', $request->name)->first();
        }

        // $connector_id = $match_connector->id;

        // 顧客テーブル必須項目
        $match_customer = Customer::where('name', $request->name_1)->first();
        
        if (empty($match_customer)) {
            // 顧客登録がない場合
            $customer->connector_id = $connector_id;
            $customer->name = $request->name_1;
            $customer->furigana = $request->furigana_1;
            $customer->save();
        }

        // 予約テーブル必須項目
        // $reservation->connector_id = $connector_id;
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
        
        // $reservation->save();
        $match_connector->reservations()->save($reservation);

        return redirect()->route('reservations.index');
    }
}
