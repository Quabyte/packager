<?php

namespace App\Models;

use App\Jobs\BookSeats;
use App\Jobs\ReleaseSeats;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'order_items';

    /**
     * Fillable Properties
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'quantity',
        'unit_price',
        'subtotal',
        'order_id'
    ];

    /**
     * Returns the order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    /**
     * Creates the OrderItems on the database
     *
     * @param $data
     * @param $order
     */
    public static function createItems($data, $order)
    {
        foreach ($data as $itemData) {
            $item = new OrderItem();
            $item->type = $itemData['type'];

            Seat::bookParticularSeatOnDatabase($itemData['uuid'], $order);

            $item->quantity = 1;
            $item->uuid = $itemData['uuid'];
            $item->unit_price = $itemData['price'];
            $item->subtotal = $itemData['price'] * $item->quantity;
            $item->order_id = $order;
            $item->created_at = Carbon::now('Europe/Istanbul');
            $item->updated_at = Carbon::now('Europe/Istanbul');
            $item->save();
        }
    }

    /**
     * Creates Hotel OrderItems
     *
     * @param $uuid
     * @param $request
     */
    public static function createHotelItems($uuid, $request)
    {
        $order = Order::where('unique_id', '=', $uuid)->first();

        $hotel = Hotel::where('unique_identifier', '=', $request->uuid)->first();

        $hotelRoom = HotelRoom::where([
            ['hotel_id', '=', $hotel->id],
            ['type', '=', $request->roomType]
        ])->first();

        $calculatedPrice = Hotel::calculateStay($request->checkIn, $request->checkOut, $hotelRoom->price);

        $item = new OrderItem();
        $item->type = 'hotel';
        $item->uuid = $request->uuid;
        $item->quantity = $request->quantity;
        $item->unit_price = $calculatedPrice;
        $item->subtotal = $calculatedPrice * $request->quantity;
        $item->order_id = $order->id;
        $item->created_at = Carbon::now('Europe/Istanbul');
        $item->updated_at = Carbon::now('Europe/Istanbul');
        $item->save();
    }
}
