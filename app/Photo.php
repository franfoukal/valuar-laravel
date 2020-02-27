<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'path', 'extension', 'active',
        'product_id', 'user_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function profile(){
        return $this->belongsTo(User::class)->latest();
    }
}
