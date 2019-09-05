@extends('layout')

@section('title', '連絡者編集')

@section('content')
    <div class="container py-4">
        <form action="{{ route('connectors.edit', ['id' => $connector->id]) }}" method="post">
            @csrf
            <div class="w-75 mx-auto">
                <div class="h4">連絡者編集フォーム</div>
                <div class="border bg-white px-5 py-4">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $message)
                                <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group row">
                        <label for="id" class="col-3 offset-1">連絡者ID：</label>
                        <div class="col-3 offset-1">
                            {{ $connector->id }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-1"><span class="badge badge-danger">必須</span></div>
                        <label for="name" class="col-3">氏名</label>
                        <div class="col-3 offset-1">
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $connector->name) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-1"><span class="badge badge-danger">必須</span></div>
                        <label for="furigana" class="col-3">ふりがな</label>
                        <div class="col-3 offset-1">
                            <input type="text" class="form-control" name="furigana" id="furigana" value="{{ old('furigana', $connector->furigana) }}" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="zip_cord" class="col-3 offset-1">郵便番号<span class="ml-2">※半角数字</span></label>
                        <div class="col-3 offset-1">
                            <input type="text" class="form-control" name="zip_code" id="zip_code" value="{{ old('zip_code', $connector->zip_code) }}" placeholder="000-0000" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-3 offset-1">住所</label>
                        <div class="col-6 offset-1">
                            <input type="text" class="form-control" name="address" id="address" value="{{ old('address', $connector->address) }}" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mark" class="col-3 offset-1">目印</label>
                        <div class="col-6 offset-1">
                            <input type="text" class="form-control" name="mark" id="mark" value="{{ old('mark', $connector->mark) }}" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="home_phone" class="col-3 offset-1">電話番号（自宅）</label>
                        <div class="col-3 offset-1">
                            <input type="text" class="form-control" name="home_phone" id="home_phone" value="{{ old('home_phone', $connector->home_phone) }}" placeholder="00-0000-0000" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cell_phone" class="col-3 offset-1">電話番号（携帯）</label>
                        <div class="col-3 offset-1">
                            <input type="text" class="form-control" name="cell_phone" id="cell_phone" value="{{ old('cell_phone', $connector->cell_phone) }}" placeholder="000-0000-0000" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mail" class="col-3 offset-1">メールアドレス</label>
                        <div class="col-6 offset-1">
                            <input type="email" class="form-control" name="mail" id="mail" value="{{ old('mail', $connector->mail) }}" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="connect_method" class="col-3 offset-1">小物の連絡方法</label>
                        <div class="col-3 offset-1">
                            <select class="form-control" name="connect_method" id="connect_method" >
                                <option value="" >選択してください</option>
                                <option value="1" @if(old('connect_method',$connector->connect_method) == '1') selected @endif>メール</option>
                                <option value="2" @if(old('connect_method',$connector->connect_method) == '2') selected @endif>FAX</option>
                                <option value="3" @if(old('connect_method',$connector->connect_method) == '3') selected @endif>郵送</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_student" class="col-3 offset-1">当院生徒か</label>
                        <div class="col-3 offset-1">
                            <select class="form-control" name="is_student" id="is_student" >
                                <option value="" >選択してください</option>
                                <option value="1" @if(old('is_student',$connector->is_student) == '1') selected @endif>外部</option>
                                <option value="2" @if(old('is_student',$connector->is_student) == '2') selected @endif>生徒</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="special" class="col-3 offset-1">特記事項</label>
                        <div class="col-6 offset-1">
                            <textarea class="form-control" name="special" id="special" rows="5">{{ old('special', $connector->special) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-3 mr-5">
                    <input type="submit" value="保存" class="btn btn-success">
                </div>
            </div>
        </form>
    </div> 
@endsection