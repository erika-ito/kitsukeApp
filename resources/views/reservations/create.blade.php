@extends('layout')

@section('title', '予約登録')

@section('content')
    <div class="container py-4">
        <form action="{{ route('masters.create') }}" method="post">
            @csrf
            <div class="h4 ml-5">予約登録フォーム</div>
                <div class="master-create-wrapper border bg-white px-5 py-4">
                    <!-- <div class="h4 mb-5">予約登録フォーム</div> -->
                    <!-- エラー表示 -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $message)
                            <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                        </div>
                    @endif

                    <!-- 登録フォーム 1 -->
                        <div class="form-group row mt-2">
                            <div class="col-1"><span class="badge badge-danger">必須</span></div>
                            <label for="status" class="col-2">予約状況</label>
                            <div class="col-2">
                                <select class="form-control" name="status" id="status" >
                                    <option value="1" @if(old('status') == '1') selected @endif>仮予約</option>
                                    <option value="2" @if(old('status') == '2') selected @endif>講師探し</option>
                                    <option value="3" @if(old('status') == '3') selected @endif>返信待ち</option>
                                    <option value="4" @if(old('status') == '4') selected @endif>予約確定</option>
                                    <option value="5" @if(old('status') == '5') selected @endif>給与待ち</option>
                                    <option value="6" @if(old('status') == '6') selected @endif>終了</option>
                                    <option value="7" @if(old('status') == '7') selected @endif>キャンセル</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-1"><span class="badge badge-danger">必須</span></div>
                            <label for="user" class="col-2">受付者</label>
                            <div class="col-2">
                                <input type="text" class="form-control" name="user" id="user" value="{{ old('user') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-1"><span class="badge badge-danger">必須</span></div>
                            <label for="reservation_date" class="col-2">受付日</label>
                            <div class="col-2">
                                <input type="text" class="form-control" name="reservation_date" id="reservation_date" value="{{ old('reservation_date') }}">
                            </div>
                            <div class="col-1 offset-1"><span class="badge badge-danger">必須</span></div>
                            <label for="reservation_type" class="col-2">受付方法</label>
                            <div class="col-2">
                                <select class="form-control" name="reservation_type" id="reservation_type" >
                                    <option value="1" @if(old('reservation_type') == '1') selected @endif>電話</option>
                                    <option value="2" @if(old('reservation_type') == '2') selected @endif>メール</option>
                                    <option value="3" @if(old('reservation_type') == '3') selected @endif>対面</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-1"><span class="badge badge-danger">必須</span></div>
                            <label for="reply" class="col-2">折り返し連絡</label>
                            <div class="col-2">
                                <select class="form-control" name="reply" id="reply" >
                                    <option value="1" @if(old('reply') == '1') selected @endif>必要</option>
                                    <option value="2" @if(old('reply') == '2') selected @endif>不要</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-1"><span class="badge badge-danger">必須</span></div>
                            <label for="location_type" class="col-2">着付場所分類</label>
                            <div class="col-2">
                                <select class="form-control" name="location_type" id="location_type" >
                                    <option value="1" @if(old('location_type') == '1') selected @endif>自宅</option>
                                    <option value="2" @if(old('location_type') == '2') selected @endif>青山校</option>
                                    <option value="3" @if(old('location_type') == '3') selected @endif>銀座校</option>
                                    <option value="4" @if(old('location_type') == '4') selected @endif>吉祥寺校</option>
                                    <option value="5" @if(old('location_type') == '5') selected @endif>室町校</option>
                                    <option value="6" @if(old('location_type') == '6') selected @endif>その他</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-1"><span class="badge badge-danger">必須</span></div>
                            <label for="location_date" class="col-2">出張日</label>
                            <div class="col-2">
                                <input type="date" class="form-control" name="location_date" id="location_date" value="{{ old('location_date') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-1"><span class="badge badge-danger">必須</span></div>
                            <label for="finish_time" class="col-2">仕上がり時間</label>
                            <div class="col-2">
                                <input type="time" class="form-control" name="finish_time" id="finish_time" value="{{ old('finish_time') }}">
                            </div>
                            <div class="col-1 offset-1"><span class="badge badge-danger">必須</span></div>
                            <label for="start_time" class="col-2">訪問時間</label>
                            <div class="col-2">
                                <input type="time" class="form-control" name="start_time" id="start_time" value="{{ old('start_time') }}">
                            </div>
                        </div>
                        <br>
                        <hr>

                        <div class="form-group row">
                            <div class="col-1"><span class="badge badge-danger">必須</span></div>
                            <label for="name" class="col-2">連絡者氏名</label>
                            <div class="col-2">
                                <input type="time" class="form-control" name="name" id="name" value="{{ old('name') }}">
                            </div>
                            <div class="col-1 offset-1"><span class="badge badge-danger">必須</span></div>
                            <label for="furigana" class="col-2">ふりがな</label>
                            <div class="col-2">
                                <input type="time" class="form-control" name="furigana" id="furigana" value="{{ old('furigana') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-1"><span class="badge badge-danger">必須</span></div>
                            <label for="count_person" class="col-2">着付人数</label>
                            <div class="col-2">
                                <input type="number" class="form-control" name="count_person" id="count_person" value="{{ old('count_person') }}">
                            </div>
                            <div class="col-1 offset-1"><span class="badge badge-danger">必須</span></div>
                            <label for="count_master" class="col-2">講師人数</label>
                            <div class="col-2">
                                <input type="number" class="form-control" name="count_master" id="count_master" value="{{ old('count_master') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cell_phone" class="col-2 offset-1">電話番号（携帯）</label>
                            <div class="col-2">
                                <input type="text" class="form-control" name="cell_phone" id="cell_phone" value="{{ old('cell_phone') }}" placeholder="000-0000-0000">
                            </div>
                            <label for="home_phone" class="col-2 offset-2">電話番号（自宅）</label>
                            <div class="col-2">
                                <input type="text" class="form-control" name="home_phone" id="home_phone" value="{{ old('home_phone') }}" placeholder="00-0000-0000">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mail" class="col-2 offset-1">メールアドレス</label>
                            <div class="col-4">
                                <input type="email" class="form-control" name="mail" id="mail" value="{{ old('mail') }}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="zip_code" class="col-2 offset-1">郵便番号</label>
                            <div class="col-2">
                                <input type="text" class="form-control" name="zip_code" id="zip_code" value="{{ old('zip_code') }}" >                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-2 offset-1">住所</label>
                            <div class="col-6">
                                <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}">                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mark" class="col-2 offset-1">到着までの目印</label>
                            <div class="col-6">
                                <input type="text" class="form-control" name="mark" id="mark" value="{{ old('mark') }}">                            
                            </div>
                        </div>
                        <br>
                        <hr>

                        <div class="form-group row">
                            <label for="location_name" class="col-2 offset-1">出張先（自宅以外）</label>
                            <div class="col-2">
                                <input type="text" class="form-control" name="location_name" id="location_name" value="{{ old('location_name') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location_zip_code" class="col-2 offset-1">出張先郵便番号</label>
                            <div class="col-2">
                                <input type="text" class="form-control" name="location_zip_code" id="location_zip_code" value="{{ old('location_zip_code') }}" >                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location_address" class="col-2 offset-1">出張先住所</label>
                            <div class="col-6">
                                <input type="text" class="form-control" name="location_address" id="location_address" value="{{ old('location_address') }}">                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location_phone" class="col-2 offset-1">出張先電話番号</label>
                            <div class="col-2">
                                <input type="text" class="form-control" name="location_phone" id="location_phone" value="{{ old('location_phone') }}" placeholder="00-0000-0000">
                            </div>
                        </div>
                        <br>
                        <hr>
                        


                        <!-- <div class="form-group row">
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
                        </div> -->
                </div>
            <div class="row">
                <div class="col-2 offset-9 mt-3">
                    <input type="submit" value="登録" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div> 
@endsection