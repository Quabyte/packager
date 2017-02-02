<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index()
    {
        $venue = Storage::get('seatbit/venue.json');
        return view('frontend.home', compact('venue'));
    }

    public function package()
    {
        return view('frontend.package');
    }
}
