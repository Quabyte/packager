<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    protected $table = 'hotel_rooms';

    protected $fillable = [
        'hotel_id',
        'name',
        'price',
        'type'
    ];

    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotel');
    }
}
