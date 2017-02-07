<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }

    public function package()
    {
        return view('frontend.package');
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
