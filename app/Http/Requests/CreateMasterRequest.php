<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMasterRequest extends FormRequest
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
            'rank' => 'required',
            'name' => 'required',
            'furigana' => 'required',
            'zip_code' => 'required',
            'address' => 'required',
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
        ];
    }
}
