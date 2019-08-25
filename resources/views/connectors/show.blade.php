@extends('layout')

@section('title', '連絡者詳細')

@section('content')
    <div class="container py-4">
        <div class="w-75 mx-auto">
            <div class="h4">連絡者詳細</div>
            <div class="border bg-white px-5 py-4">
                <div class="row">
                    <label for="id" class="col-3 offset-1">連絡者ID：</label>
                    <div class="col-3 offset-1">
                        {{ $connector->id }}
                    </div>
                </div>
                <div class="row">
                    <label for="name" class="col-3 offset-1">氏名：</label>
                    <div class="col-3 offset-1">
                        {{ $connector->name }}
                    </div>
                </div>
                <div class="row">
                    <label for="furigana" class="col-3 offset-1">ふりがな：</label>
                    <div class="col-3 offset-1">
                        {{ $connector->furigana }}
                    </div>
                </div>
                <div class="row">
                    <label for="zip_cord" class="col-3 offset-1">郵便番号<span class="ml-2">※半角数字：</span></label>
                    <div class="col-3 offset-1">
                        {{ $connector->zip_code }}
                    </div>
                </div>
                <div class="row">
                    <label for="address" class="col-3 offset-1">住所：</label>
                    <div class="col-6 offset-1">
                        {{ $connector->address }}
                    </div>
                </div>
                <div class="row">
                    <label for="mark" class="col-3 offset-1">目印：</label>
                    <div class="col-6 offset-1">
                        {{ $connector->mark }}
                    </div>
                </div>
                <div class="row">
                    <label for="home_phone" class="col-3 offset-1">電話番号（自宅）：</label>
                    <div class="col-3 offset-1">
                        {{ $connector->home_phone }}
                    </div>
                </div>
                <div class="row">
                    <label for="cell_phone" class="col-3 offset-1">電話番号（携帯）：</label>
                    <div class="col-3 offset-1">
                        {{ $connector->cell_phone }}
                    </div>
                </div>
                <div class="row">
                    <label for="mail" class="col-3 offset-1">メールアドレス：</label>
                    <div class="col-6 offset-1">
                        {{ $connector->mail }}
                    </div>
                </div>
                <div class="row">
                    <label for="connect_method" class="col-3 offset-1">小物の連絡方法：</label>
                    <div class="col-3 offset-1">
                        {{ $connector->formatted_connect_method }}
                    </div>
                </div>
                <div class="row">
                    <label for="is_student" class="col-3 offset-1">当院生徒か：</label>
                    <div class="col-3 offset-1">
                        {{ $connector->formatted_is_student }}
                    </div>
                </div>
                <div class="row">
                    <label for="address" class="col-3 offset-1">特記事項：</label>
                    <div class="col-6 offset-1">
                        {{ $connector->special }}
                    </div>
                </div>
            </div>
            <div class="text-right mt-3 mr-5">
                <a href="{{ route('connectors.edit', ['id' => $connector->id]) }}" class="btn btn-success">編集</a>
            </div>
        </div>
    </div> 
@endsection