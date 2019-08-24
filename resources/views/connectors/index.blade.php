@extends('layout')

@section('title', '連絡者一覧')

@section('content')
    <div class="container">
        <div class="row pt-3">
            <!-- 検索フォーム -->
            <div class="col-10">
                <form action="" method="get" class="form-inline">
                    <div class="form-group mr-5">
                        <input type="text" name="keyword" class="form-control" value="{{ $keyword }}" placeholder="氏名">
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
                    <tr class="table-info d-flex">
                        <th scope="col" class="col-1">利用回数</th>
                        <th scope="col" class="col-1">直近利用日</th>
                        <th scope="col" class="col-2">氏名</th>
                        <th scope="col" class="col-3">住所</th>
                        <th scope="col" class="col-1">連絡先</th>
                        <th scope="col" class="col-2">メールアドレス</th>
                        <th scope="col" class="col-1"></th>
                        <th scope="col" class="col-1"></th>
                    </tr>
                </thead>
                <tbody class="bg-light">
                    @foreach ($connectors as $connector)
                        <tr class="d-flex">
                            <td class="col-1">{{ $connector->total_count }}</td>
                            <td class="col-1">{{ $connector->formatted_current_use_date }}</td>
                            <td class="col-2">{{ $connector->name }}</td>
                            <td class="col-3">{{ $connector->address }}</td>
                            <td class="col-1">{{ $connector->cell_phone }}</td>
                            <td class="col-2 overflow">{{ $connector->mail }}</td>
                            <td class="col-1">
                                <a href="" class="btn btn-success">詳細</a>
                            </td>
                            <td class="col-1">
                                <a href="" class="btn btn-re-reservation">再予約</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- ページネーション -->
            <div class="d-flex justify-content-center mt-2">
                {{ $connectors->appends(['keyword' => $keyword])->links() }}
            </div>
        </div>
    </div>
@endsection