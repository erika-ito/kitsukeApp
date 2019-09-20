<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            // 必須（一人目のみ）
            'name_1' => 'required',
            'furigana_1' => 'required',
            // 初回任意
            'age_1' => 'numeric | nullable',
            'height_1' => 'numeric | nullable',
            'body_type_1' => 'integer | nullable', 

            'age_2' => 'numeric | nullable',
            'height_2' => 'numeric | nullable',
            'body_type_2' => 'integer | nullable',

            'age_3' => 'numeric | nullable',
            'height_3' => 'numeric | nullable',
            'body_type_3' => 'integer | nullable',

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
        
            // 担当講師テーブル項目
            'master_1' => 'nullable | exists:masters,name',
            'master_2' => 'nullable | exists:masters,name',
            'master_3' => 'nullable | exists:masters,name',
            'master_4' => 'nullable | exists:masters,name',
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
            'name_1' => '氏名（着付1人目）',
            'furigana_1' => 'ふりがな（着付1人目）',
            'age_1' => '年齢（着付1人目）',
            'height_1' => '身長（着付1人目）',
            'body_type_1' => '体型（着付1人目）',

            'name_2' => '氏名（着付2人目）',
            'furigana_2' => 'ふりがな（着付2人目）',
            'age_2' => '年齢（着付2人目）',
            'height_2' => '身長（着付2人目）',
            'body_type_2' => '体型（着付2人目）',

            'name_3' => '氏名（着付3人目）',
            'furigana_3' => 'ふりがな（着付3人目）',
            'age_3' => '年齢（着付3人目）',
            'height_3' => '身長（着付3人目）',
            'body_type_3' => '体型（着付3人目）',

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

            // 担当講師テーブル項目
            'master_1' => '担当講師名（1人目）',
            'master_2' => '担当講師名（2人目）',
            'master_3' => '担当講師名（3人目）',
            'master_4' => '担当講師名（4人目）',
        ];
    }
}
