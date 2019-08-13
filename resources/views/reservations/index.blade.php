@extends('layout')

@section('title', '予約一覧')

@section('content')
    <div class="container">
        <div class="row pt-3">
            <!-- 検索フォーム -->
            <div class="col-10">
                <form action="" method="get" class="form-inline">
                    <div class="form-group mr-5">
                        <input type="text" name="keyword" class="form-control" value="" placeholder="日付、氏名　等">
                    </div>
                    <input type="submit" value="検索" class="btn btn-info">
                </form>
            </div>
            <!-- 新規登録ボタン -->
            <div class="col-2">
                <a href="" class="btn btn-warning">新規登録</a>
            </div>
        </div>

        <div class="reservations-list-wrapper py-4">
            <div class="h4">予約一覧</div>
            <!-- 予約一覧表 -->
            <table class="table">
                <thead>
                    <tr class="table-info text-center">
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
                            <td>{{ $reservation->status }}</td>
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
                                    <p>{{ $customer->pivot->kimono_type }}</p>
                                @endforeach
                            </td>
                            <td>
                                <a href="" class="btn btn-success">詳細</a>
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td>予約済</td>
                        <td>2019/8/1</td>
                        <td>7:30～8:30</td>
                        <td>伊藤絵里香</td>
                        <td>1</td>
                        <td>伊藤絵里香</td>
                        <td>色無地</td>
                        <td>
                            <a href="" class="btn btn-success">詳細</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- ページネーション -->
            <div class="d-flex justify-content-center mt-2">
            </div>
        </div>
    </div>
@endsection