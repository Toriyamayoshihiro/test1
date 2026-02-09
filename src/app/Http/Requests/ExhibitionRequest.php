<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'image' => ['required','image'],
            'name' => 'required',
            'description' =>['required','max:255'],
            'item_category' => ['required','array'],
            'condition_id' => 'required',
            'price' => ['required','integer','min:0',]
        ];
    }
    public function messages()
    {
        return[
            'image.required' => '画像をアップロードしてください',
            'image.image' => '- `「.png」または「.jpeg」形式でアップロードしてください`',
            'name.required' => '商品名を入力してください',
            'description.required' => '商品の説明を入力してください',
            'description.max' => '商品の説明は255文字以内で入力してください',
            'item_category.required' => 'カテゴリーを選択してください',
            'condition_id.required' => '商品の状態を選択してください',
            'price.required' => '商品の金額を入力してください',
            'price.integer' => '数値で入力してください',
            'price.min' => '0円以上から入力してください',
        ];
    }
}
