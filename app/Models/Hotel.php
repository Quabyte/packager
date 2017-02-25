<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'unique_identifier',
        'name',
        'media_path',
        'stars',
        'review_point',
        'review_count',
        'location',
        'description'
    ];

    public function rooms()
    {
        return $this->hasMany('App\Models\HotelRoom');
    }

    public static function calculateStay($checkIn, $checkOut, $price)
    {
        return $total = ($checkOut - $checkIn) * $price;
    }

    public static function listHotels($orderID)
    {
        $hotels = OrderItem::where([
            ['type', '=', 'hotel'],
            ['order_id', '=', $orderID]
        ])->get();

        return $hotels;
    }
}
