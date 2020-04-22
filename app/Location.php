<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public $guarded = ['id', 'created_at', 'updated_at'];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
