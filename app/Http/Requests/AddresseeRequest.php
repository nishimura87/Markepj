<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddresseeRequest extends FormRequest
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
            'name' => 'required|string|max:20',
            'kana' => 'required|string|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u|max:20',
            'postcode' => 'required|regex:/\A\d{3}[-]\d{4}\z/',
            'address' => 'required',
            'phone_number' => 'required|numeric|digits_between:8,11',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は入力必須です',
            'name.string' => '名前は文字列で入力してください',
            'name.max' => '名前は20文字以内で入力してください',
            'kana.required' => '名前(カタカナ)は入力必須です',
            'kana.string' => '名前(カタカナ)は文字列で入力してください',
            'kana.regix' => '名前(カタカナ)はカタカナで入力してください',
            'kana.max' => '名前(カタカナ)は20文字以内で入力してください',
            'postcode.required' => '郵便番号は入力必須です',
            'postcode.regex' => '郵便番号はハイフンを含めた８文字で入力してください',
            'address.required' => '住所は入力必須です',
            'phone_number.required' => '電場番号は入力必須です',
            'phone_number.numeric' => '電話番号はハイフンを除く数字形式で入力してください',
            'phone_number.digits_between' => '電場番号は8〜11文字の数字で入力してください',
        ];
    }
}