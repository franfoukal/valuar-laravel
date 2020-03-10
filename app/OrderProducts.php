<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    protected $table = 'order_has_products';

    protected $fillable = ['quantity', 'individual_price', 'active', 'orders_id', 'products_id'];
}
