<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceCategory extends Model
{
    protected $table = 'price_categories';

    protected $fillable = [
        'name',
        'price',
        'color',
        'available',
        'online'
    ];

    public function seats()
    {
        return $this->hasMany('App\Models\Seat');
    }

    public static function checkMultipleZones($categoryID)
    {
        $category = PriceCategory::findOrFail($categoryID);

        $zones = explode('.', $category->zones);

        if (count($zones) > 1) {
            return true;
        } else {
            return false;
        }
    }

    public static function getZones($categoryID)
    {
        $category = PriceCategory::findOrFail($categoryID);

        $zones = explode('.', $category->zones);

        return $zones;
    }
}
