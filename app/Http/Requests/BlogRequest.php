<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    /**
     * バリデーションルール
     */
    public function rules()
    {
        return [
            'blog.title' => 'required|string|max:255',
            'blog.body' => 'required|string',
            'blog.category_id' => 'required|exists:categories,id',
            'blog.items' => 'nullable|array',
            'blog.items.*.name' => 'required_with:blog.items|string|max:255',
            'blog.items.*.price' => 'required_with:blog.items|numeric|min:0',
            'blog.items.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'blog.items.*.existing_image' => 'nullable|string',
        ];
    }

    /**
     * カスタムエラーメッセージ
     */
    public function messages()
    {
        return [
            'blog.title.required' => 'タイトルは必須です。',
            'blog.title.string' => 'タイトルは文字列で入力してください。',
            'blog.title.max' => 'タイトルは255文字以内で入力してください。',
            'blog.body.required' => '本文は必須です。',
            'blog.body.string' => '本文は文字列で入力してください。',
            'blog.category_id.required' => 'カテゴリーを選択してください。',
            'blog.category_id.exists' => '選択したカテゴリーが無効です。',
            'blog.items.*.name.required_with' => '商品名を入力してください。',
            'blog.items.*.name.string' => '商品名は文字列で入力してください。',
            'blog.items.*.name.max' => '商品名は255文字以内で入力してください。',
            'blog.items.*.price.required_with' => '価格を入力してください。',
            'blog.items.*.price.numeric' => '価格は数値で入力してください。',
            'blog.items.*.price.min' => '価格は0以上で入力してください。',
        ];
    }
}
