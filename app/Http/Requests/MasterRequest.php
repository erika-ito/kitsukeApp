<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MasterRequest extends FormRequest
{    
    protected $redirectRoute = 'masters.create';
    
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
            'rank' => 'required | integer',
            'name' => 'required',
            'furigana' => 'required',
            'zip_code' => 'required | alpha_dash',
            'address' => 'required',
            
            // 任意
            'home_phone' => 'alpha_dash | nullable',
            'cell_phone' => 'alpha_dash | nullable',
            'mail' => 'email | nullable',
        ];
    }

    public function attributes()
    {
        return [
            'rank' => '優先度',
            'name' => '氏名',
            'furigana' => 'ふりがな',
            'zip_code' => '郵便番号',
            'address' => '住所',
            'home_phone' => '電話番号（自宅）',
            'cell_phone' => '電話番号（携帯）',
            'mail' => 'メールアドレス',
        ];
    }
}
