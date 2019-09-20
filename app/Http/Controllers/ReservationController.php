<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Connector;
use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Services\ReservationService;

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
    public function create(ReservationRequest $request, ReservationService $service)
    {
        $service->create($request);

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
    public function edit(ReservationRequest $request, int $id, ReservationService $service)
    {
        $reservation = $service->edit($request, $id);

        return redirect()->route('reservations.show', [
            'reservation' => $reservation,
            'id' => $id,
        ]);
    }
}
