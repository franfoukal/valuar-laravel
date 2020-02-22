<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'barcode', 'has_size', 
        'description', 'stock', 'active', 'category_id', 
        'material_id'
    ];

    
}
