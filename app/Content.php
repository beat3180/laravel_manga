<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//ユーザーID取得用の継承
use Illuminate\Support\Facades\Auth;

class Content extends Model
{

    /*public static $rules = array(
        'タイトル' => 'required|between:1,100',
        'コンテンツ' => 'required|between:1,2000',
        'カテゴリー' => 'required',
        '記事画像' => 'image|file',
        'ステータス' => 'required',
    );*/


    public function getIsApprovedAttribute(): bool
    {
        return $this->approved_at ? true : false;
    }

    protected $table = 'contents';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
