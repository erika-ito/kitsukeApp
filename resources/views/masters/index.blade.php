@extends('layout')

@section('title', '講師一覧')

@section('content')
    <div class="container">
        <div class="row pt-3">
            <!-- 検索フォーム -->
            <div class="col-10">
                <form action="" method="get" class="form-inline">
                    <div class="form-group mr-5">
                        <input type="text" name="keyword" class="form-control" value="" placeholder="講師名">
                    </div>
                    <input type="submit" value="検索" class="btn btn-info">
                </form>
            </div>
            <!-- 新規登録ボタン -->
            <div class="col-2">
                <a href="" class="btn btn-warning">新規登録</a>
            </div>
        </div>

        <div class="masters-list-wrapper py-4">
            <div class="h4">講師一覧</div>
            <!-- 講師一覧表 -->
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
                    @foreach ($masters as $master)
                        <tr>
                            <td>{{ $master->rank }}</td>
                            <td>{{ $master->name }}</td>
                            <td>{{ $master->zip_code }}</td>
                            <td>{{ $master->address }}</td>
                            <td>{{ $master->home_phone }}</td>
                            <td>{{ $master->cell_phone }}</td>
                            <td>{{ $master->mail }}</td>
                            <td>
                                <a href="" class="btn btn-success">編集</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- ページネーション -->
            <div class="d-flex justify-content-center mt-2">
                {{ $masters->links() }}
            </div>
        </div>
    </div>
@endsection
