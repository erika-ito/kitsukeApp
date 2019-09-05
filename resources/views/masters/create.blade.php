@extends('layout')

@section('title', '講師登録')

@section('content')
    <div class="container py-4">
        <form action="{{ route('masters.create') }}" method="post">
            @csrf
            <div class="w-75 mx-auto">
                <div class="h4">講師登録フォーム</div>
                <div class="master-create-wrapper border bg-white px-5 py-4">
                    <!-- <div class="h4 mb-5">講師登録フォーム</div> -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $message)
                            <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                        </div>
                    @endif
                        <div class="form-group row mt-2">
                            <div class="col-1"><span class="badge badge-danger">必須</span></div>
                            <label for="rank" class="col-3">優先度</label>
                            <div class="col-3 offset-1">
                                <select class="form-control" name="rank" id="rank" >
                                    <option value="" >選択してください</option>
                                    <option value="5" @if(old('rank') == '5') selected @endif>5</option>
                                    <option value="4" @if(old('rank') == '4') selected @endif>4</option>
                                    <option value="3" @if(old('rank') == '3') selected @endif>3</option>
                                    <option value="2" @if(old('rank') == '2') selected @endif>2</option>
                                    <option value="1" @if(old('rank') == '1') selected @endif>1</option>
                                    <option value="0" @if(old('rank') == '0') selected @endif>出張不可</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-1"><span class="badge badge-danger">必須</span></div>
                            <label for="name" class="col-3">氏名</label>
                            <div class="col-3 offset-1">
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-1"><span class="badge badge-danger">必須</span></div>
                            <label for="furigana" class="col-3">ふりがな</label>
                            <div class="col-3 offset-1">
                                <input type="text" class="form-control" name="furigana" id="furigana" value="{{ old('furigana') }}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-1"><span class="badge badge-danger">必須</span></div>
                            <label for="zip_cord" class="col-3">郵便番号<span class="ml-2">※半角数字</span></label>
                            <div class="col-3 offset-1">
                                <input type="text" class="form-control" name="zip_code" id="zip_code" value="{{ old('zip_code') }}" placeholder="000-0000" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-1"><span class="badge badge-danger">必須</span></div>
                            <label for="address" class="col-3">住所</label>
                            <div class="col-6 offset-1">
                                <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="home_phone" class="col-3 offset-1">電話番号（自宅）</label>
                            <div class="col-3 offset-1">
                                <input type="text" class="form-control" name="home_phone" id="home_phone" value="{{ old('home_phone') }}" placeholder="00-0000-0000" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cell_phone" class="col-3 offset-1">電話番号（携帯）</label>
                            <div class="col-3 offset-1">
                                <input type="text" class="form-control" name="cell_phone" id="cell_phone" value="{{ old('cell_phone') }}" placeholder="000-0000-0000" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mail" class="col-3 offset-1">メールアドレス</label>
                            <div class="col-6 offset-1">
                                <input type="email" class="form-control" name="mail" id="mail" value="{{ old('mail') }}" >
                            </div>
                        </div>
                </div>
                <div class="text-right mt-3 mr-5">
                    <input type="submit" value="登録" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
@endsection