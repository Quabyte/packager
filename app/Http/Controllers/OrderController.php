<?php

namespace App\Http\Controllers;

use App\Jobs\ReleaseSeats;
use App\Jobs\UpdateJsonView;
use App\Models\Hotel;
use App\Models\Order;
use App\Models\Seat;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $uuid = session()->get('uuid');

        if (Order::checkIfExists($uuid)) {

            Order::updateOrder($request, $uuid);

        } else {
            Order::createNewOrder($request, $uuid);
        }

        return response()->json(['uuid' => $uuid]);


        // Create a new Job to generate the new JSON.
        // Add to Queue the package in order to clear it.
    }

    /**
     * Adds Selected Hotel to the Cart
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addHotelToCart(Request $request)
    {
        $uuid = session()->get('uuid');

        if (Order::checkIfExists($uuid)) {
            Order::updateWithHotelOrder($uuid, $request);
        } else {
            return redirect()->action('ApplicationController@index');
        }

        return redirect()->to('/package/' . $uuid);
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
        $hotels = Hotel::all();

        if (Auth::check()) {
            Order::assignUserId($order);
            $payment = Order::preparePayment($order);
        }

        $seats = Seat::where('order_id', '=', $order->id)->get();

        dispatch(new UpdateJsonView($seats));

//        $releaseSeats = (new ReleaseSeats($order->id))
//                                ->delay(Carbon::now('Europe/Istanbul')->addMinutes(20));
//
//        dispatch($releaseSeats);

        if (session()->has('uuid')) {
            return view('frontend.package', compact('order', 'hotels', 'payment'));
        } else {
            return redirect()->action('ApplicationController@index');
        }
    }

    public function confirmation(Request $request)
    {
        if (!Order::confirmed($request)) {
            $message = 'Your payment is not successfull! Please try again!';
        } elseif (!Order::checkStillAvailable($request)) {
            $message = 'Your selected seats are not available since you exceed 20 minutes of purchase time. We will refund your money back in 24 hours!';
        } else {
            $message = 'Your purchase is successfull!';
        }

        return view('frontend.confirmation', compact('message'));
    }
}
