<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'title',
        'quantity',
        'unit_price',
        'subtotal',
        'order_id'
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
