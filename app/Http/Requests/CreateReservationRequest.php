<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 連絡者テーブル項目
            // 必須
            'name'=> 'required',
            'furigana' => 'required',

            // 初回任意
            'zip_code' => 'alpha_dash | nullable',
            'home_phone' => 'alpha_dash | nullable',
            'cell_phone' => 'alpha_dash | nullable',
            'mail' => 'email | nullable',
            'connect_method' => 'integer | nullable',
            'is_student' => 'integer | nullable',

            // 顧客テーブル項目
            // 必須
            'name' => 'required',
            'furigana' => 'required',
            // 初回任意
            'age' => 'numeric | nullable',
            'height' => 'numeric | nullable',
            'body_type' => 'integer | nullable', 

            // 予約テーブル項目
            // 必須
            'status' => 'required | integer',
            'user' => 'required',
            'reservation_date' => 'required | date',
            'reservation_type' => 'required | integer',
            'reply' => 'required | integer',
            'location_type' => 'required | integer',
            'location_date' => 'required | date | after_or_equal:reservation_date',
            'finish_time' => 'required',
            'start_time' => 'required',
            'count_person' => 'required | numeric',
            'count_master' => 'required | numeric',
            'purpose' => 'required',

            // 初回任意
            'location_zip_code' => 'alpha_dash | nullable',
            'location_phone' => 'alpha_dash | nullable',
            'tool_buying' => 'integer | nullable',
            'total_price' => 'numeric | nullable',
            'tool_connect_date' => 'date | after_or_equal:reservation_date | nullable',
            'tool_confirm_date' => 'date | after_or_equal:reservation_date | nullable',
            'master_request_date' => 'date | after_or_equal:reservation_date | nullable',
            'tool_pass_date' => 'date | after_or_equal:reservation_date | nullable',
            'payment' => 'numeric | nullable',
        ];
    }

    public function attributes()
    {
        return [
            // 連絡者テーブル項目
            'name' => '連絡者氏名',
            'furigana' => 'ふりがな',
            'zip_code' => '郵便番号',
            'home_phone' => '電話番号（自宅）',
            'cell_phone' => '電話番号（携帯）',
            'mail' => 'メールアドレス',
            'connect_method' => '小物の連絡方法',
            'is_student' => '当院生徒か',

            // 顧客テーブル項目
            'name' => '氏名',
            'furigana' => 'ふりがな',
            'age' => '年齢',
            'height' => '身長',
            'body_type' => '体型',

            // 予約テーブル項目
            'status' => '予約状況',
            'user' => '受付担当',
            'reservation_date' => '受付日',
            'reservation_type' => '受付方法',
            'reply' => '折り返し連絡',
            'location_type' => '着付場所分類',
            'location_date' => '出張日',
            'finish_time' => '仕上がり時間',
            'start_time' => '訪問時間',
            'count_person' => '着付人数',
            'count_master' => '講師人数',
            'purpose' => '着用目的',
            'location_zip_code' => '出張先郵便番号',
            'location_phone' => '出張先電話番号',
            'tool_buying' => '小物の購入',
            'total_price' => '合計金額',
            'tool_connect_date' => '小物連絡日',
            'tool_confirm_date' => '小物確認日',
            'master_request_date' => '講師依頼日',
            'tool_pass_date' => 'セット渡し日',
            'payment' => '給与合計',
        ];
    }
}
