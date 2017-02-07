<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'unique_id',
        'user_id',
        'status',
        'total',
        'currency'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orderItems()
    {
        return $this->hasMany('App\Models\OrderItem');
    }
}
