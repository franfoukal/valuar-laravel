<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = 'categories';
    public $guarded = ['id', 'created_at','updated_at'];

    public function products(){
        return $this->hasMany('App\Product',  'category_id');
    }
}
