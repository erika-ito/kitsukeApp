@extends('layout')

@section('title', '講師一覧')

@section('content')
    <div class="container">
        <div class="row pt-3">
            <!-- 検索フォーム -->
            <div class="col-10">
                <form action="" method="get" class="form-inline">
                    <div class="form-group mr-5">
                        <input type="text" name="keyword" class="form-control" value="{{ $keyword }}" placeholder="講師名">
                    </div>
                    <input type="submit" value="検索" class="btn btn-info">
                </form>
            </div>
            <!-- 新規登録ボタン -->
            <div class="col-2">
                <a href="{{ route('masters.create') }}" class="btn btn-warning">新規登録</a>
            </div>
        </div>

        <div class="masters-list-wrapper py-4">
            <div class="h4">講師一覧</div>
            <!-- 講師一覧表 -->
            <table class="table">
                <thead>
                    <tr class="table-info text-center row">
                        <th scope="col" class="col-1">優先度</th>
                        <th scope="col" class="col-2">氏名</th>
                        <th scope="col" class="col-1">郵便番号</th>
                        <th scope="col" class="col-3">住所</th>
                        <th scope="col" class="col-1">自宅</th>
                        <th scope="col" class="col-1">携帯</th>
                        <th scope="col" class="col-2">メールアドレス</th>
                        <th scope="col" class="col-1"></th>
                    </tr>
                </thead>
                <tbody class="bg-light">
                    @foreach ($masters as $master)
                        <tr class="row">
                            <td class="col-1">{{ $master->rank }}</td>
                            <td class="col-2">{{ $master->name }}</td>
                            <td class="col-1">{{ $master->zip_code }}</td>
                            <td class="col-3">{{ $master->address }}</td>
                            <td class="col-1">{{ $master->home_phone }}</td>
                            <td class="col-1">{{ $master->cell_phone }}</td>
                            <td class="col-2">{{ $master->mail }}</td>
                            <td class="col-1">
                                <a href="" class="btn btn-success">編集</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- ページネーション -->
            <div class="d-flex justify-content-center mt-2">
                {{ $masters->appends(['keyword' => $keyword])->links() }}
            </div>
        </div>
    </div>
@endsection
