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
}
