<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = array('id');


    protected $table = "categories";

    public function contents()
    {
        return $this->hasMany('App\Content');
    }


    /*public static $rules = array(
        'category' => 'required | between:1,100',
    );*/
}
