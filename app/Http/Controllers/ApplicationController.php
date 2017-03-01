<?php

namespace App\Http\Controllers;

use App\SeatByte\Utilities;
use Illuminate\Http\Request;
use App\Models\PriceCategory;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index()
    {
        $categories = PriceCategory::where('online', '=', true)->get();
        if (session()->has('uuid')) {
            $uuid = session()->get('uuid');
        } else {
            $uuid = session()->put('uuid', str_random(6));
        }

        return view('frontend.home', compact('categories', 'uuid'));
    }

    public function loadVenue()
    {
        $venue = Storage::get('seatbit/venue.json');

        return response($venue);
    }

    public function getData($fileName)
    {
        $path = 'seatbit/zones/' . $fileName . '.json';
        $data = Storage::get($path);

        return response($data);
    }

    public function countdown()
    {
        return view('frontend.countdown');
    }

    public function redirectHome()
    {
        return redirect()->action('ApplicationController@index');
    }
}
