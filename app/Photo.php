<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'path', 'extension', 'active',
        'product_id', 'user_id'
    ];
}
