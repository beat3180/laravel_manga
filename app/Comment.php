<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    public function content()
    {
        return $this->belongsTo('App\Content');
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
