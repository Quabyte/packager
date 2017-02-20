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

    public static function createNewRoom($data, $hotelID)
    {
        $room = new HotelRoom();
        $room->hotel_id = $hotelID;
        $room->name = $data->roomName;
        $room->price = $data->roomPrice;
        $room->type = $data->roomType;
        $room->save();
    }
}
