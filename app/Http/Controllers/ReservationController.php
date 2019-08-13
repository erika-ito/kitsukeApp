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
        $columns = [
            'id',
            'status',
            'location_date',
            'start_time',
            'finish_time',
            'connector_id',
            'count_person',
        ];

        $reservations = Reservation::get($columns);

        return view('reservations.index', [
            'reservations' => $reservations,
        ]);
    }
}
