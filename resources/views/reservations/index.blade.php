@extends('layout')

@section('title', '予約一覧')

@section('content')
    <div class="container">
        <div class="row pt-3">
            <!-- 検索フォーム -->
            <div class="col-7">
                <form action="" method="get" class="form-inline">
                    <div class="form-group mr-5">
                        <input type="text" name="keyword" class="form-control" value="{{ $keyword }}" placeholder="出張日、連絡者氏名">
                    </div>
                    <input type="submit" value="検索" class="btn btn-info">
                </form>
            </div>

            <!-- 過去・キャンセル表示ボタン -->
            <div class="col-3 text-right">
                <form action="" method="get">
                    <input type="hidden"" name="pass_cancel" value="pass_cancel">
                    <input type="submit" value="過去・キャンセル一覧" class="btn btn-secondary">
                </form>
            </div>

            <!-- 新規登録ボタン -->
            <div class="col-2">
                <a href="{{ route('reservations.create') }}" class="btn btn-warning">新規登録</a>
            </div>
        </div>

        <div class="reservations-list-wrapper py-4">
            <div class="h4">予約一覧</div>
            <!-- 予約一覧表 -->
            <table class="table">
                <thead>
                    <tr class="table-info">
                        <th scope="col">予約状況</th>
                        <th scope="col">出張日</th>
                        <th scope="col">時間帯</th>
                        <th scope="col">連絡者氏名</th>
                        <th scope="col">人数</th>
                        <th scope="col">担当講師</th>
                        <th scope="col">着付内容</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="bg-light">
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->formatted_status }}</td>
                            <td>{{ $reservation->formatted_location_date }}</td>
                            <td>
                                {{ $reservation->formatted_start_time }}
                                ～
                                {{ $reservation->formatted_finish_time }}
                            </td>
                            <td>{{ $reservation->connector->name }}</td>
                            <td>{{ $reservation->count_person }}</td>
                            <td>
                                @foreach ($reservation->masters as $master)
                                    <p>{{ $master->name }}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($reservation->customers as $customer)
                                    <p>{{ $customer->pivot->formatted_kimono_type }}</p>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('reservations.show', ['id' => $reservation->id]) }}" class="btn btn-success">詳細</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- ページネーション -->
            <div class="d-flex justify-content-center mt-2">
                {{ $reservations->appends(['keyword' => $keyword])->links() }}
            </div>
        </div>
    </div>
@endsection