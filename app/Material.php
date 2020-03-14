<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public $table = 'materials';
    public $guarded = ['id', 'created_at','updated_at'];

    public function products(){
        return $this->hasMany('App\Product',  'material_id');
    }
}
