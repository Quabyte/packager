<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $table = 'seats';

    protected $fillable = [
        'category_id',
        'order_id',
        'uuid',
        'zone',
        'row',
        'number',
        'status',
    ];

    public function priceCategory()
    {
        return $this->belongsTo('App\Models\PriceCategory', 'id', 'category_id');
    }
}
