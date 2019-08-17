@extends('layout')

@section('title', '予約登録')

@section('content')
    <div class="container py-4">
        <form action="{{ route('masters.create') }}" method="post">
            @csrf
            <div class="h4">予約登録フォーム</div>
            <div class="master-create-wrapper border bg-white px-5 py-4">
                
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
                <div class="reservation-form-1 pt-3 d-none">
                    <div class="form-group row">
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
                        <div class="col-3">
                            <input type="date" class="form-control" name="reservation_date" id="reservation_date" value="{{ old('reservation_date', $today) }}">
                        </div>
                        <div class="col-1"><span class="badge badge-danger">必須</span></div>
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
                        <div class="col-3">
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
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                        </div>
                        <div class="col-1 offset-1"><span class="badge badge-danger">必須</span></div>
                        <label for="furigana" class="col-2">ふりがな</label>
                        <div class="col-2">
                            <input type="text" class="form-control" name="furigana" id="furigana" value="{{ old('furigana') }}">
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
                        <div class="col-6">
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
                    
                    <div class="form-group row">
                        <label for="connect_method" class="col-2 offset-1">小物の連絡方法</label>
                        <div class="col-2">
                            <select class="form-control" name="connect_method" id="connect_method" >
                                <option value="1" @if(old('connect_method') == '1') selected @endif>メール</option>
                                <option value="2" @if(old('connect_method') == '2') selected @endif>FAX</option>
                                <option value="3" @if(old('connect_method') == '3') selected @endif>郵送</option>
                            </select>                            </div>
                        <label for="tool_buying" class="col-2 offset-2">小物の購入</label>
                        <div class="col-2">
                            <select class="form-control" name="tool_buying" id="tool_buying" >
                                <option value="1" @if(old('tool_buying') == '1') selected @endif>なし</option>
                                <option value="2" @if(old('tool_buying') == '2') selected @endif>脱脂綿</option>
                                <option value="3" @if(old('tool_buying') == '3') selected @endif>腰ひも</option>
                                <option value="4" @if(old('tool_buying') == '4') selected @endif>その他（備考）</option>
                            </select>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_student" class="col-2 offset-1">当院生徒か</label>
                        <div class="col-2">
                            <select class="form-control" name="is_student" id="is_student" >
                                <option value="1" @if(old('is_student') == '1') selected @endif>外部</option>
                                <option value="2" @if(old('is_student') == '2') selected @endif>生徒</option>
                            </select>
                        </div>
                    </div>
                    <br>

                    <div class="form-group row">
                        <label for="distance" class="col-2 offset-1">最寄りからの距離</label>
                        <div class="col-6">
                            <input type="text" class="form-control" name="distance" id="distance" value="{{ old('distance') }}">                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="total_price" class="col-2 offset-1">合計金額</label>
                        <div class="col-2">
                            <input type="number" class="form-control" name="total_price" id="total_price" value="{{ old('total_price') }}">                            
                        </div>
                    </div>
                    <br>
                    <hr>
                    

                    <div class="form-group row">
                        <label for="tool_connect_date" class="col-2 offset-1">小物連絡日</label>
                        <div class="col-3">
                            <input type="date" class="form-control" name="tool_connect_date" id="tool_connect_date" value="{{ old('tool_connect_date') }}" placeholder="000-0000-0000">
                        </div>
                        <label for="tool_confirm_date" class="col-2 offset-1">小物確認日</label>
                        <div class="col-3">
                            <input type="date" class="form-control" name="tool_confirm_date" id="tool_confirm_date" value="{{ old('tool_confirm_date') }}" placeholder="00-0000-0000">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="master_request_date" class="col-2 offset-1">講師依頼日</label>
                        <div class="col-3">
                            <input type="date" class="form-control" name="master_request_date" id="master_request_date" value="{{ old('master_request_date') }}" placeholder="000-0000-0000">
                        </div>
                        <label for="tool_pass_date" class="col-2 offset-1">セット渡し日</label>
                        <div class="col-3">
                            <input type="date" class="form-control" name="tool_pass_date" id="tool_pass_date" value="{{ old('tool_pass_date') }}" placeholder="00-0000-0000">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="payment" class="col-2 offset-1">給与合計</label>
                        <div class="col-2">
                            <input type="number" class="form-control" name="payment" id="payment" value="{{ old('payment') }}">                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="thoughts" class="col-2 offset-1">講師感想</label>
                        <div class="col-6">
                            <textarea class="form-control" name="thoughts" id="thoughts" rows="5">{{ old('thoughts') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- 登録フォーム 2 -->
                <div class="reservation-form-2 pt-3">
                    <div class="form-group row">
                        <div class="col-1"><span class="badge badge-danger">必須</span></div>
                        <label for="purpose" class="col-2">着用目的</label>
                        <div class="col-2">
                            <input type="text" class="form-control" name="purpose" id="purpose" value="{{ old('purpose') }}">
                        </div>
                    </div>
                    <hr>

                    <!-- 着付対象者 -->
                    <div class="customer">
                        <p>【着付1人目（必須）】</p>
                        <div class="form-group row">
                            <div class="col-1"><span class="badge badge-danger">必須</span></div>
                            <label for="name" class="col-2">氏名</label>
                            <div class="col-2">
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                            </div>
                            <div class="col-1 offset-1"><span class="badge badge-danger">必須</span></div>
                            <label for="furigana" class="col-2">ふりがな</label>
                            <div class="col-2">
                                <input type="text" class="form-control" name="furigana" id="furigana" value="{{ old('furigana') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="age" class="col-2 offset-1">年齢</label>
                            <div class="col-2">
                                <input type="number" class="form-control" name="age" id="age" value="{{ old('age') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="height" class="col-2 offset-1">身長</label>
                            <div class="col-2">
                                <input type="number" class="form-control" name="height" id="height" value="{{ old('height') }}">
                            </div>
                            <label for="body_type" class="col-2 offset-2">体型</label>
                            <div class="col-2">
                                <select class="form-control" name="body_type" id="body_type" >
                                    <option value="1" @if(old('body_type') == '1') selected @endif>ほそめ</option>
                                    <option value="2" @if(old('body_type') == '2') selected @endif>ふつう</option>
                                    <option value="3" @if(old('body_type') == '3') selected @endif>ふっくら</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kimono_type" class="col-2 offset-1">着物の種類</label>
                            <div class="col-2">
                                <select class="form-control" name="kimono_type" id="kimono_type" >
                                    <option value="1" @if(old('status') == '1') selected @endif>白無垢</option>
                                    <option value="2" @if(old('status') == '2') selected @endif>色打掛</option>
                                    <option value="3" @if(old('status') == '3') selected @endif>紋付袴</option>
                                    <option value="4" @if(old('status') == '4') selected @endif>振袖</option>
                                    <option value="5" @if(old('status') == '5') selected @endif>留袖</option>
                                    <option value="6" @if(old('status') == '6') selected @endif>色留袖</option>
                                    <option value="7" @if(old('status') == '7') selected @endif>喪服</option>
                                    <option value="8" @if(old('status') == '8') selected @endif>訪問着</option>
                                    <option value="9" @if(old('status') == '9') selected @endif>付け下げ</option>
                                    <option value="10" @if(old('status') == '10') selected @endif>色無地</option>
                                    <option value="11" @if(old('status') == '11') selected @endif>小紋</option>
                                    <option value="12" @if(old('status') == '12') selected @endif>女袴</option>
                                    <option value="13" @if(old('status') == '13') selected @endif>七五三</option>
                                    <option value="14" @if(old('status') == '14') selected @endif>浴衣</option>
                                    <option value="15" @if(old('status') == '15') selected @endif>その他（備考）</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="obi_type" class="col-2 offset-1">帯の種類</label>
                            <div class="col-2">
                                <select class="form-control" name="obi_type" id="obi_type" >
                                    <option value="1" @if(old('obi_type') == '1') selected @endif>名古屋帯</option>
                                    <option value="2" @if(old('obi_type') == '2') selected @endif>袋帯</option>
                                    <option value="3" @if(old('obi_type') == '3') selected @endif>その他（備考）</option>
                                </select>
                            </div>
                            <label for="obi_knot" class="col-2 offset-2">結び方</label>
                            <div class="col-2">
                                <select class="form-control" name="obi_knot" id="obi_knot" >
                                    <option value="1" @if(old('obi_knot') == '1') selected @endif>お太鼓</option>
                                    <option value="2" @if(old('obi_knot') == '2') selected @endif>二重太鼓</option>
                                    <option value="3" @if(old('obi_knot') == '3') selected @endif>変わり結び</option>
                                    <option value="4" @if(old('obi_knot') == '4') selected @endif>その他（備考）</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="customer">
                        <p>【着付2人目】</p>
                        <div class="form-group row">
                            <label for="name" class="col-2 offset-1">氏名</label>
                            <div class="col-2">
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                            </div>
                            <label for="furigana" class="col-2 offset-2">ふりがな</label>
                            <div class="col-2">
                                <input type="text" class="form-control" name="furigana" id="furigana" value="{{ old('furigana') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="age" class="col-2 offset-1">年齢</label>
                            <div class="col-2">
                                <input type="number" class="form-control" name="age" id="age" value="{{ old('age') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="height" class="col-2 offset-1">身長</label>
                            <div class="col-2">
                                <input type="number" class="form-control" name="height" id="height" value="{{ old('height') }}">
                            </div>
                            <label for="body_type" class="col-2 offset-2">体型</label>
                            <div class="col-2">
                                <select class="form-control" name="body_type" id="body_type" >
                                    <option value="1" @if(old('body_type') == '1') selected @endif>ほそめ</option>
                                    <option value="2" @if(old('body_type') == '2') selected @endif>ふつう</option>
                                    <option value="3" @if(old('body_type') == '3') selected @endif>ふっくら</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kimono_type" class="col-2 offset-1">着物の種類</label>
                            <div class="col-2">
                                <select class="form-control" name="kimono_type" id="kimono_type" >
                                    <option value="1" @if(old('status') == '1') selected @endif>白無垢</option>
                                    <option value="2" @if(old('status') == '2') selected @endif>色打掛</option>
                                    <option value="3" @if(old('status') == '3') selected @endif>紋付袴</option>
                                    <option value="4" @if(old('status') == '4') selected @endif>振袖</option>
                                    <option value="5" @if(old('status') == '5') selected @endif>留袖</option>
                                    <option value="6" @if(old('status') == '6') selected @endif>色留袖</option>
                                    <option value="7" @if(old('status') == '7') selected @endif>喪服</option>
                                    <option value="8" @if(old('status') == '8') selected @endif>訪問着</option>
                                    <option value="9" @if(old('status') == '9') selected @endif>付け下げ</option>
                                    <option value="10" @if(old('status') == '10') selected @endif>色無地</option>
                                    <option value="11" @if(old('status') == '11') selected @endif>小紋</option>
                                    <option value="12" @if(old('status') == '12') selected @endif>女袴</option>
                                    <option value="13" @if(old('status') == '13') selected @endif>七五三</option>
                                    <option value="14" @if(old('status') == '14') selected @endif>浴衣</option>
                                    <option value="15" @if(old('status') == '15') selected @endif>その他（備考）</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="obi_type" class="col-2 offset-1">帯の種類</label>
                            <div class="col-2">
                                <select class="form-control" name="obi_type" id="obi_type" >
                                    <option value="1" @if(old('obi_type') == '1') selected @endif>名古屋帯</option>
                                    <option value="2" @if(old('obi_type') == '2') selected @endif>袋帯</option>
                                    <option value="3" @if(old('obi_type') == '3') selected @endif>その他（備考）</option>
                                </select>
                            </div>
                            <label for="obi_knot" class="col-2 offset-2">帯結び</label>
                            <div class="col-2">
                                <select class="form-control" name="obi_knot" id="obi_knot" >
                                    <option value="1" @if(old('obi_knot') == '1') selected @endif>お太鼓</option>
                                    <option value="2" @if(old('obi_knot') == '2') selected @endif>二重太鼓</option>
                                    <option value="3" @if(old('obi_knot') == '3') selected @endif>変わり結び</option>
                                    <option value="4" @if(old('obi_knot') == '4') selected @endif>その他（備考）</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    
                    <div class="customer">
                        <p>【着付3人目】</p>
                        <div class="form-group row">
                            <label for="name" class="col-2 offset-1">氏名</label>
                            <div class="col-2">
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                            </div>
                            <label for="furigana" class="col-2 offset-2">ふりがな</label>
                            <div class="col-2">
                                <input type="text" class="form-control" name="furigana" id="furigana" value="{{ old('furigana') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="age" class="col-2 offset-1">年齢</label>
                            <div class="col-2">
                                <input type="number" class="form-control" name="age" id="age" value="{{ old('age') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="height" class="col-2 offset-1">身長</label>
                            <div class="col-2">
                                <input type="number" class="form-control" name="height" id="height" value="{{ old('height') }}">
                            </div>
                            <label for="body_type" class="col-2 offset-2">体型</label>
                            <div class="col-2">
                                <select class="form-control" name="body_type" id="body_type" >
                                    <option value="1" @if(old('body_type') == '1') selected @endif>ほそめ</option>
                                    <option value="2" @if(old('body_type') == '2') selected @endif>ふつう</option>
                                    <option value="3" @if(old('body_type') == '3') selected @endif>ふっくら</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kimono_type" class="col-2 offset-1">着物の種類</label>
                            <div class="col-2">
                                <select class="form-control" name="kimono_type" id="kimono_type" >
                                    <option value="1" @if(old('status') == '1') selected @endif>白無垢</option>
                                    <option value="2" @if(old('status') == '2') selected @endif>色打掛</option>
                                    <option value="3" @if(old('status') == '3') selected @endif>紋付袴</option>
                                    <option value="4" @if(old('status') == '4') selected @endif>振袖</option>
                                    <option value="5" @if(old('status') == '5') selected @endif>留袖</option>
                                    <option value="6" @if(old('status') == '6') selected @endif>色留袖</option>
                                    <option value="7" @if(old('status') == '7') selected @endif>喪服</option>
                                    <option value="8" @if(old('status') == '8') selected @endif>訪問着</option>
                                    <option value="9" @if(old('status') == '9') selected @endif>付け下げ</option>
                                    <option value="10" @if(old('status') == '10') selected @endif>色無地</option>
                                    <option value="11" @if(old('status') == '11') selected @endif>小紋</option>
                                    <option value="12" @if(old('status') == '12') selected @endif>女袴</option>
                                    <option value="13" @if(old('status') == '13') selected @endif>七五三</option>
                                    <option value="14" @if(old('status') == '14') selected @endif>浴衣</option>
                                    <option value="15" @if(old('status') == '15') selected @endif>その他（備考）</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="obi_type" class="col-2 offset-1">帯の種類</label>
                            <div class="col-2">
                                <select class="form-control" name="obi_type" id="obi_type" >
                                    <option value="1" @if(old('obi_type') == '1') selected @endif>名古屋帯</option>
                                    <option value="2" @if(old('obi_type') == '2') selected @endif>袋帯</option>
                                    <option value="3" @if(old('obi_type') == '3') selected @endif>その他（備考）</option>
                                </select>
                            </div>
                            <label for="obi_knot" class="col-2 offset-2">結び方</label>
                            <div class="col-2">
                                <select class="form-control" name="obi_knot" id="obi_knot" >
                                    <option value="1" @if(old('obi_knot') == '1') selected @endif>お太鼓</option>
                                    <option value="2" @if(old('obi_knot') == '2') selected @endif>二重太鼓</option>
                                    <option value="3" @if(old('obi_knot') == '3') selected @endif>変わり結び</option>
                                    <option value="4" @if(old('obi_knot') == '4') selected @endif>その他（備考）</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    
                    <!-- 備考 -->
                    <div class="form-group row">
                        <label for="notes" class="col-2 offset-1">備考</label>
                        <div class="col-6">
                            <textarea class="form-control" name="notes" id="notes" rows="5">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 送信ボタン -->
            <div class="row">
                <div class="col-2 offset-9 mt-3">
                    <input type="submit" value="登録" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div> 
@endsection