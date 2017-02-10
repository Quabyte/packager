<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class OrderController extends Controller
{
    /**
     * Add to Package
     *
     * @param Request $request
     */
    public function addToCart(Request $request)
    {
        $uuid = Cookie::get('uuid');
        Order::createNewOrder($request, $uuid);
    }

    /**
     * Gets the specified order with items
     *
     * @param $uuid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showOrder($uuid)
    {
        $order = Order::where('unique_id', '=', $uuid)->first();

        if (Cookie::get('uuid') === $uuid) {
            return view('frontend.package', compact('order'));
        } else {
            return redirect()->action('ApplicationController@index');
        }
    }
}
