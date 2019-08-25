<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConnectorRequest extends FormRequest
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
            // 必須
            'name'=> 'required',
            'furigana' => 'required',

            // 任意
            'zip_code' => 'alpha_dash | nullable',
            'home_phone' => 'alpha_dash | nullable',
            'cell_phone' => 'alpha_dash | nullable',
            'mail' => 'email | nullable',
            'connect_method' => 'integer | nullable',
            'is_student' => 'integer | nullable',
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
        ];
    }
}
