@extends('layout')

@section('title', '予約詳細')

@section('content')
    <div class="container py-4">
        <div class="h4">予約詳細</div>
        <div class="border bg-white px-5 py-4">
            <!-- 詳細画面 1 -->
            <div id="reservation-show-1" class="pt-3">
                <div class="row">
                    <label for="id" class="col-2 offset-1">予約ID：</label>
                    <div class="col-2">
                        {{ $reservation->id }}
                    </div>
                </div>
                <div class="row">
                    <label for="status" class="col-2 offset-1">予約状況：</label>
                    <div class="col-2">
                        {{ $reservation->status }}
                    </div>
                </div>
                <div class="row">
                    <label for="user" class="col-2 offset-1">受付者：</label>
                    <div class="col-2">
                        {{ $reservation->user }}
                    </div>
                </div>
                <div class="row">
                    <label for="reservation_date" class="col-2 offset-1">受付日：</label>
                    <div class="col-3">
                        {{ $reservation->formatted_reservation_date }}
                    </div>
                    <label for="reservation_type" class="col-2 offset-1">受付方法：</label>
                    <div class="col-2">
                        {{ $reservation->reservation_type }}
                    </div>
                </div>
                <div class="row">
                    <label for="reply" class="col-2 offset-1">折り返し連絡：</label>
                    <div class="col-2">
                        {{ $reservation->reply }}
                    </div>
                </div>
                <div class="row">
                    <label for="location_type" class="col-2 offset-1">着付場所分類：</label>
                    <div class="col-2">
                        {{ $reservation->location_type }}
                    </div>
                </div>
                <div class="row">
                    <label for="location_date" class="col-2 offset-1">出張日：</label>
                    <div class="col-3">
                        {{ $reservation->formatted_location_date }}
                    </div>
                </div>
                <div class="row">
                    <label for="finish_time" class="col-2 offset-1">仕上がり時間：</label>
                    <div class="col-2">
                        {{ $reservation->formatted_finish_time }}
                    </div>
                    <label for="start_time" class="col-2 offset-2">訪問時間：</label>
                    <div class="col-2">
                        {{ $reservation->formatted_start_time }}
                    </div>
                </div>
                <br>
                <hr>

                <div class="row">
                    <label for="name" class="col-2 offset-1">連絡者氏名：</label>
                    <div class="col-2">
                        {{ $reservation->connector->name }}
                    </div>
                    <label for="furigana" class="col-2 offset-2">ふりがな：</label>
                    <div class="col-2">
                        {{ $reservation->connector->furigana }}
                    </div>
                </div>
                <div class="row">
                    <label for="count_person" class="col-2 offset-1">着付人数：</label>
                    <div class="col-2">
                        {{ $reservation->count_person }}　名
                    </div>
                    <label for="count_master" class="col-2 offset-2">講師人数：</label>
                    <div class="col-2">
                        {{ $reservation->count_master }}　名
                    </div>
                </div>
                <div class="row">
                    <label for="cell_phone" class="col-2 offset-1">電話番号（携帯）：</label>
                    <div class="col-2">
                        {{ $reservation->connector->cell_phone }}
                    </div>
                    <label for="home_phone" class="col-2 offset-2">電話番号（自宅）：</label>
                    <div class="col-2">
                        {{ $reservation->connector->home_phone }}
                    </div>
                </div>
                <div class="row">
                    <label for="mail" class="col-2 offset-1">メールアドレス：</label>
                    <div class="col-6">
                        {{ $reservation->connector->mail }}
                    </div>
                </div>
                <div class="row">
                    <label for="zip_code" class="col-2 offset-1">郵便番号：</label>
                    <div class="col-2">
                        {{ $reservation->connector->zip_code }}
                    </div>
                </div>
                <div class="row">
                    <label for="address" class="col-2 offset-1">住所：</label>
                    <div class="col-6">
                        {{ $reservation->connector->address }}
                    </div>
                </div>
                <div class="row">
                    <label for="mark" class="col-2 offset-1">到着までの目印：</label>
                    <div class="col-6">
                        {{ $reservation->connector->mark }}
                    </div>
                </div>
                <br>
                <hr>

                <div class="row">
                    <label for="location_name" class="col-2 offset-1">出張先（自宅外）：</label>
                    <div class="col-2">
                        {{ $reservation->location_name }}
                    </div>
                </div>
                <div class="row">
                    <label for="location_zip_code" class="col-2 offset-1">出張先郵便番号：</label>
                    <div class="col-2">
                        {{ $reservation->location_zip_code }}
                    </div>
                </div>
                <div class="row">
                    <label for="location_address" class="col-2 offset-1">出張先住所：</label>
                    <div class="col-6">
                        {{ $reservation->location_address }}
                    </div>
                </div>
                <div class="row">
                    <label for="location_phone" class="col-2 offset-1">出張先電話番号：</label>
                    <div class="col-2">
                        {{ $reservation->location_phone }}
                    </div>
                </div>
                <br>
                <hr>
                
                <div class="row">
                    <label for="connect_method" class="col-2 offset-1">小物の連絡方法：</label>
                    <div class="col-2">
                        {{ $reservation->connector->connect_method }}
                    </div>
                    <label for="tool_buying" class="col-2 offset-2">小物の購入：</label>
                    <div class="col-2">
                        {{ $reservation->tool_buying }}
                    </div>
                </div>
                <div class="row">
                    <label for="is_student" class="col-2 offset-1">当院生徒か：</label>
                    <div class="col-2">
                        {{ $reservation->connector->is_student }}
                    </div>
                </div>
                <br>

                <div class="row">
                    <label for="distance" class="col-2 offset-1">最寄り駅からの距離：</label>
                    <div class="col-6">
                        {{ $reservation->distance }}
                    </div>
                </div>
                <div class="row">
                    <label for="total_price" class="col-2 offset-1">合計金額：</label>
                    <div class="col-2">
                        {{ $reservation->comma_total_price }}　円
                    </div>
                </div>
                <br>
                <hr>
                
                <div class="row">
                    <label for="master_name_1" class="col-2 offset-1">担当講師：</label>
                    @foreach ($reservation->masters as $master)
                        <div class="col-2">
                            {{ $master->name }}
                        </div>
                    @endforeach
               </div>
                <div class="row">
                    <label for="tool_connect_date" class="col-2 offset-1">小物連絡日：</label>
                    <div class="col-3">
                        {{ $reservation->formatted_tool_connect_date }}
                    </div>
                    <label for="tool_confirm_date" class="col-2 offset-1">小物確認日：</label>
                    <div class="col-3">
                        {{ $reservation->formatted_tool_confirm_date }}
                    </div>
                </div>
                <div class="row">
                    <label for="master_request_date" class="col-2 offset-1">講師依頼日：</label>
                    <div class="col-3">
                        {{ $reservation->formatted_master_request_date }}
                    </div>
                    <label for="tool_pass_date" class="col-2 offset-1">セット渡し日：</label>
                    <div class="col-3">
                        {{ $reservation->formatted_tool_pass_date }}
                    </div>
                </div>
                <div class="row">
                    <label for="payment" class="col-2 offset-1">給与合計：</label>
                    <div class="col-2">
                        {{ $reservation->comma_payment }}　円
                    </div>
                </div>
                <div class="row">
                    <label for="thoughts" class="col-2 offset-1">講師感想：</label>
                    <div class="col-6">
                        {{ $reservation->thoughts }}
                    </div>
                </div>
            </div>

            <!-- 詳細画面 2 -->
            <div id="reservation-show-2" class="pt-3 d-none">
                <div class="row">
                    <label for="purpose" class="col-2 offset-1">着用目的：</label>
                    <div class="col-2">
                        結婚式
                    </div>
                </div>
                <hr>

                <!-- 着付対象者 -->
                @foreach ($reservation->customers as $customer)
                    <div class="customer">
                        <p>【着付対象者】</p>
                        <div class="row">
                            <label for="name" class="col-2 offset-1">氏名：</label>
                            <div class="col-2">
                                {{ $customer->name }}
                            </div>
                            <label for="furigana" class="col-2 offset-2">ふりがな：</label>
                            <div class="col-2">
                                {{ $customer->furigana }}
                            </div>
                        </div>
                        <div class="row">
                            <label for="age" class="col-2 offset-1">年齢：</label>
                            <div class="col-2">
                                {{ $customer->age }}　歳
                            </div>
                        </div>
                        <div class="row">
                            <label for="height" class="col-2 offset-1">身長：</label>
                            <div class="col-2">
                                {{ $customer->height }}　cm
                            </div>
                            <label for="body_type" class="col-2 offset-2">体型：</label>
                            <div class="col-2">
                                {{ $customer->body_type }}
                            </div>
                        </div>
                        <div class="row">
                            <label for="kimono_type" class="col-2 offset-1">着物の種類：</label>
                            <div class="col-2">
                                {{ $customer->pivot->kimono_type }}
                            </div>
                        </div>
                        <div class="row">
                            <label for="obi_type" class="col-2 offset-1">帯の種類：</label>
                            <div class="col-2">
                                {{ $customer->pivot->obi_type }}
                            </div>
                            <label for="obi_knot" class="col-2 offset-2">帯結び：</label>
                            <div class="col-2">
                                {{ $customer->pivot->obi_knot }}
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
                

                <!-- 備考 -->
                <div class="form-group row">
                    <label for="notes" class="col-2 offset-1">備考：</label>
                    <div class="col-6">
                        {{ $reservation->notes }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="special" class="col-2 offset-1">特記事項：</label>
                    <div class="col-6">
                        {{ $reservation->connector->special }}
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 送信ボタン -->
        <div class="row">
            <div class="col-2 offset-7 mt-3">
                <button type="button" id="reservation_show_btn" class="btn btn-primary">
                    着付内容
                </button>
            </div>
            <div class="col-2 mt-3">
                <a href="" class="btn btn-success">編集</a>
            </div>
        </div>
    </div> 
@endsection

@section('scripts')
    <script>
        $(function() {
            //　青色ボタンがクリックされたとき
            $('#reservation_show_btn').click(function() {
                //　内容1・2の切り替え
                $('#reservation-show-1').toggleClass('d-none');
                $('#reservation-show-2').toggleClass('d-none');
                
                // 青色ボタンの表示文字の切り替え
                var hasNone = $('#reservation-show-2').hasClass('d-none');
                if(hasNone) {
                    $(this).text('着付内容');
                } else {
                    $(this).text('予約概要');
                }
            });
        });
    </script>
@endsection