<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\SeatByte\Utilities;
use App\User;
use Illuminate\Http\Request;
use App\Models\PriceCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    /**
     * HomePage
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * Loads Venue JSON
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function loadVenue()
    {
        $venue = Storage::get('seatbit/venue.json');

        return response($venue);
    }

    /**
     * Returns Zone JSON
     *
     * @param $fileName
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getData($fileName)
    {
        $path = 'seatbit/zones/' . $fileName . '.json';
        $data = Storage::get($path);

        return response($data);
    }

    /**
     * Countdown page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function countdown()
    {
        return view('frontend.countdown');
    }

    /**
     * Redirects the user to index page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectHome()
    {
        return redirect()->action('ApplicationController@index');
    }

    public function showProfile()
    {
        $user = Auth::user();

        if (User::hasOrders($user->id)) {
            $orders = User::listOrders($user->id);
        }

        return view('frontend.profile', compact('user', 'orders'));
    }
}
