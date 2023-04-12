<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'email' => 'required|email|max:191',
            'title' => 'required|max:50',
            'body' => 'required|max:500',
            'phone_number' => 'nullable|numeric|digits_between:8,11',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.string' => '名前は文字列で入力してください',
            'name.max' => '名前は20文字以内で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレス形式で入力してください',
            'email.max' => 'メールアドレスは191文字以内で入力してください',
            'title.required' => 'タイトルを入力してください',
            'title.max' => 'タイトルは50文字以内で入力してください',
            'body.required' => 'お問い合わせ内容を入力してください',
            'body.max' => 'お問い合わせ内容は500文字以内で入力してください',
            'phone_number.numeric' => '電話番号はハイフンを除く数字形式で入力してください',
            'phone_number.digits_between' => '電場番号は8〜11文字の数字で入力してください'
        ];
    }
}
