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
    
}
