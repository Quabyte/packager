<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeatCategory extends Model
{
    protected $table = 'seat_categories';

    protected $fillable = [
        'name',
        'price',
        'color',
        'available',
        'online'
    ];

    public static function checkMultipleZones($categoryID)
    {
        $category = SeatCategory::findOrFail($categoryID);

        $zones = explode('.', $category->zones);

        if (count($zones) > 1) {
            return true;
        } else {
            return false;
        }
    }

    public static function getZones($categoryID)
    {
        $category = SeatCategory::findOrFail($categoryID);

        $zones = explode('.', $category->zones);

        return $zones;
    }
}
