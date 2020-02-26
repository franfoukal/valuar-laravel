<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['name', 'description', 'active'];
   
/*
    public function product(){
        return $this->belongsTo(Product::class, 'material_id');
    }
    */
}
