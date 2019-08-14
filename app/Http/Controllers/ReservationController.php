<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\CreateReservationRequest;

class ReservationController extends Controller
{
    // 一覧表示（検索あり）
    public function index(Request $request)
    {
        $keyword = str_replace('/', '-', $request->keyword);

        //　下記でconnectorテーブルと結合しているため、
        //　どちらidか明示化する
        // $columns = [
        //     'reservations.id',
        //     'status',
        //     'location_date',
        //     'start_time',
        //     'finish_time',
        //     'connector_id',
        //     'count_person',
        // ];
        // $reservations = Reservation::get($columns);

        // 検索、並び替え、ページネーション
        $reservations = Reservation::keyword($keyword)
            ->orderBy('location_date','asc')
            ->orderBy('start_time','asc')
            ->paginate(5);

        // 予約一覧へ
        return view('reservations.index', [
            'reservations' => $reservations,
            'keyword' => $keyword,
        ]);
    }

    // 詳細表示
    public function show()
    {
        return view('reservations.show');
    }

    // 新規登録フォーム表示
    public function showCreateForm()
    {
        return view('reservations.create');
    }
}
