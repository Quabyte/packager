<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class OrderController extends Controller
{
    /**
     * Adds items to cart and redirects to the package.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToCart(Request $request)
    {
        $uuid = Cookie::get('uuid');

        if (Order::checkIfExists($uuid)) {
            Order::updateOrder($request, $uuid);
        } else {
            Order::createNewOrder($request, $uuid);
        }
        // Reserve the seats on JSON
        // Add to Queue the package in order to clear it.
        return response()
                    ->json([
                        'redirect' => '/package/' . $uuid
                    ])
                    ->cookie('uuid', $uuid);
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
