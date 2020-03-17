<?php

namespace App;
use App\Photo;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'barcode', 'has_size', 
        'description', 'stock', 'active', 'category_id', 
        'material_id'
    ];
    
    public function photos(){
        return $this->hasMany(Photo::class, 'product_id');
    }

    public function firstPhoto(){
        return $this->hasOne(Photo::class)->oldest();
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function material(){
        return $this->belongsTo('App\Material', 'material_id');
    }

    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }
}
