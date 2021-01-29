<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MangaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
     public function authorize()
    {
        //パスでフォームリクエストの利用を判断する。パスが一致すればフォームリクエストを使える
        if($this->path() == 'category' || 'post' || 'content' || 'content_detail')
        {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    //検証するバリデーションを設定する
    public function rules()
    {
        // バリデーションルールをまとめる配列です。
        $rules = [];

        // $this->has()は$request->has()のことです。
        // has()で指定した項目の有無を確認し、あればルールを追加します。
        if ($this->has('category')) {
            $rules['category'] = 'required|between:1,100';
        }
        if ($this->has('title')) {
            $rules['title'] = 'required|between:1,100';
        }
        if ($this->has('content')) {
            $rules['content'] = 'required|between:1,2000';
        }
        if ($this->has('category_id')) {
            $rules['category_id'] = 'required';
        }
        if ($this->has('image')) {
            $rules['image'] = 'image|file';
        }
        if ($this->has('approved_at')) {
            $rules['approved_at'] = 'required';
        }
        if ($this->has('user_id')) {
            $rules['user_id'] = 'required';
        }
        if ($this->has('admin_id')) {
            $rules['admin_id'] = 'required';
        }


        return $rules;

        /*return [
            'category' => 'required|between:1,100',
            'title' => 'required|between:1,100',
            'content' => 'required|between:1,2000',
            'category_id' => 'required',
            'image' => 'image|file',
            'approved_at' => 'required',
        ];*/
    }

    //表示するメッセージを設定する
    public function messages()
    {
        return [
            'category.required' => 'カテゴリーは必ず入力してください',
            'category.between' => 'カテゴリーは1〜100文字以内で入力してください',
            'title.required' => 'タイトルは必ず入力してください',
            'title.between' => 'タイトルは1〜100文字以内で入力してください',
            'content.required' => '記事は必ず入力してください',
            'content.between' => '記事は1〜100文字以内で入力してください',
            'image.image' => '画像ファイルの拡張子は(jpg、png、bmp、gif、svg)にしてください',
            'image.file' => 'ファイルが不正です',
        ];
    }
}
