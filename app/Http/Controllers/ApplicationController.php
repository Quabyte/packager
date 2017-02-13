<?php

namespace App\Http\Controllers;

use App\Models\SeatCategory;
use App\SeatByte\Utilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index()
    {
        $categories = SeatCategory::where('online', '=', true)->get();
        $uuid = Utilities::setUniqueCookie();

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
}
