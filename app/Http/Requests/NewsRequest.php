<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'img_path' => 'nullable|mimes:jpg,jpeg,png,gif|max:10240',
            'title' => 'required|max:50',
            'body' => 'required|max:500',
        ];
    }

    public function messages()
    {
        return [
            'img_path.max' => '10Mを超えています',
            'img_path.mimes' => '指定されたファイルが画像ではありません',
            'title.required' => 'タイトルは入力必須です',
            'title.max' => 'タイトルは50文字以内で入力してください',
            'body.required' => '商品情報は入力必須です',
            'body.max' => '商品情報は50文字以内で入力してください'
        ];
    }
}
