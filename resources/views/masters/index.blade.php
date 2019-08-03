@extends('layout')

@section('title', '講師一覧')

@section('content')
    <div class="container">
        <div class="row pt-3">
            <div class="col-10">
                <form action="" method="get" class="form-inline">
                    <div class="form-group mr-5">
                        <input type="text" name="keyword" class="form-control" value="" placeholder="講師名">
                    </div>
                    <input type="submit" value="検索" class="btn btn-info">
                </form>
            </div>
            <div class="col-2">
                <a href="" class="btn btn-warning">新規登録</a>
            </div>
        </div>

        <div class="masters-list-wrapper py-4">
            <div class="h4">講師一覧</div>
            <table class="table">
                <thead>
                    <tr class="table-info text-center">
                        <th scope="col">優先度</th>
                        <th scope="col">氏名</th>
                        <th scope="col">郵便番号</th>
                        <th scope="col">住所</th>
                        <th scope="col">自宅</th>
                        <th scope="col">携帯</th>
                        <th scope="col">メールアドレス</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="bg-light">
                    <tr>
                        <td>5</td>
                        <td>伊藤絵里香</td>
                        <td>111-1111</td>
                        <td>東京都新宿区西新宿2-8-1</td>
                        <td>03-0000-0000</td>
                        <td>090-0000-0000</td>
                        <td>abc@gmail.com</td>
                        <td>
                            <a href="" class="btn btn-success">編集</a>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                            <td>出張不可</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
