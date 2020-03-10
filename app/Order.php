<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['subtotal', 'tax_percentage', 'interest_percentage', 'receipt_type', 'receipt_number',
                        'active', 'users_id', 'status_id', 'shippings_id']; 
}
