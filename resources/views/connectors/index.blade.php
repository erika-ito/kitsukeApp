@extends('layout')

@section('title', '連絡者一覧')

@section('content')
    <div class="container">
        <div class="row pt-3">
            <!-- 検索フォーム -->
            <div class="col-10">
                <form action="" method="get" class="form-inline">
                    <div class="form-group mr-5">
                        <input type="text" name="keyword" class="form-control" value="" placeholder="氏名">
                    </div>
                    <input type="submit" value="検索" class="btn btn-info">
                </form>
            </div>
        </div>

        <div class="connector-list-wrapper py-4">
            <div class="h4">連絡者一覧</div>
            <!-- 連絡者一覧表 -->
            <table class="table">
                <thead>
                    <tr class="table-info">
                        <th scope="col">利用回数</th>
                        <th scope="col">直近利用日</th>
                        <th scope="col">氏名</th>
                        <th scope="col">住所</th>
                        <th scope="col">連絡先</th>
                        <th scope="col">メールアドレス</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="bg-light">

                    <tr>
                        <td>20</td>
                        <td>2018/8/1</td>
                        <td>伊藤絵里香</td>
                        <td>東京都新宿区</td>
                        <td>090-0000-0000</td>
                        <td>abc@gmail.com</td>
                        <td>
                            <a href="" class="btn btn-success">詳細</a>
                        </td>
                        <td>
                            <a href="" class="btn btn-re-reservation">再予約</a>
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