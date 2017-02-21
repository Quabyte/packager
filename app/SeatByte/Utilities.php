<?php

namespace App\SeatByte;

use Illuminate\Support\Facades\Cookie;

class Utilities
{

    /**
     * Sets unique identifier for the user
     *
     * @return string
     */
    public static function setUniqueCookie()
    {
        if (Cookie::get('uuid') !== null) {
            $uuid = Cookie::get('uuid');
        } else {
            $uuid = str_random(6);
            Cookie::queue('uuid', $uuid, 20);
        }

        return $uuid;
    }
}