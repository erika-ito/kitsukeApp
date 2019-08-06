@extends('layout')

@section('title', '講師登録')

@section('content')
    <div class="container py-4">
        <form action="">
            <div class="h4 ml-5">講師登録フォーム</div>
            <div class="d-flex justify-content-center">
                <div class="master-create-wrapper border bg-white w-75 px-5 py-4">
                    <!-- <div class="h4 mb-5">講師登録フォーム</div> -->
                        <div class="form-group row">
                            <label for="rank" class="col-3 offset-1"><span class="badge badge-danger mr-2">必須</span>優先度</label>
                            <div class="col-3 offset-1">
                                <input type="text" class="form-control" id="rank" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-3 offset-1"><span class="badge badge-danger mr-2">必須</span>氏名</label>
                            <div class="col-3 offset-1">
                                <input type="text" class="form-control" id="name" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="furigana" class="col-3 offset-1"><span class="badge badge-danger mr-2">必須</span>ふりがな</label>
                            <div class="col-3 offset-1">
                                <input type="text" class="form-control" id="furigana" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="zip_cord" class="col-3 offset-1"><span class="badge badge-danger mr-2">必須</span>郵便番号</label>
                            <div class="col-3 offset-1">
                                <input type="text" class="form-control" id="zip_code" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-3 offset-1"><span class="badge badge-danger mr-2">必須</span>住所</label>
                            <div class="col-6 offset-1">
                                <input type="text" class="form-control" id="address" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="home_phone" class="col-3 offset-1">電話番号（自宅）</label>
                            <div class="col-3 offset-1">
                                <input type="text" class="form-control" id="home_phone" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cell_phone" class="col-3 offset-1">電話番号（携帯）</label>
                            <div class="col-3 offset-1">
                                <input type="text" class="form-control" id="cell_phone" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mail" class="col-3 offset-1">メールアドレス</label>
                            <div class="col-6 offset-1">
                                <input type="email" class="form-control" id="mail" >
                            </div>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-2 offset-8 mt-3">
                    <!-- <button type="submit" class="btn btn-primary">登録</button>     -->
                    <input type="submit" value="登録" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div> 
@endsection