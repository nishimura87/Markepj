<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'img_path.*' => 'nullable|mimes:jpg,jpeg,png,gif|max:10240',
            'img_path.0' => 'required|nullable|mimes:jpg,jpeg,png,gif|max:10240',
            'title' => 'required|max:50',
            'info' => 'required|max:500',
            'color' => 'required|max:20',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'material' => 'required|max:50',
            'part_number' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'img_path.*.required' => '写真を1枚は選択してください',
            'img_path.*.max' => '10Mを超えています',
            'img_path.*.mimes' => '指定されたファイルが画像ではありません',
            'title.required' => 'タイトルは入力必須です',
            'title.max' => 'タイトルは50文字以内で入力してください',
            'info.required' => '商品情報は入力必須です',
            'info.max' => '商品情報は500文字以内で入力してください',
            'color.required' => 'カラーは入力必須です',
            'color.max' => 'カラーは20文字以内で入力してください',
            'price.required' => '価格は入力必須です',
            'price.numeric' => '価格は半角数字で入力してください',
            'quantity.required' => '在庫数は入力必須です',
            'quantity.rnumeric' => '在庫数は半角数字で入力してください',
            'material.required' => '素材は入力必須です',
            'material.max' => '素材は50文字以内で入力してください',
            'part_number.required' => '商品番号は入力必須です',
        ];
    }
}