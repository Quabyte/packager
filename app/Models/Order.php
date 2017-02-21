<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * Mass assignable fields
     *
     * @var array
     */
    protected $fillable = [
        'unique_id',
        'user_id',
        'status',
        'total',
        'currency'
    ];

    /**
     * Returns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Returns the OrderItems
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

    /**
     * Creates the order on the database.
     *
     * @param $data
     * @param $uuid
     */
    public static function createNewOrder($data, $uuid)
    {
        $order = new Order();
        $order->unique_id = $uuid;
        $order->status = 'not-completed';
        $order->total = $data->total;
        $order->currency = 949;
        $order->created_at = Carbon::now('Europe/Istanbul');
        $order->updated_at = Carbon::now('Europe/Istanbul');
        $order->save();

        // Create OrderItems
        OrderItem::createItems($data->items, $order->id);
    }

    /**
     * Update existing order
     *
     * @param $data
     * @param $uuid
     */
    public static function updateOrder($data, $uuid)
    {
        $order = Order::where('unique_id', '=', $uuid)->first();

        OrderItem::createItems($data->items, $order->id);

        $order->total = Order::calculateOrderTotal($order->id);
        $order->updated_at = Carbon::now('Europe/Istanbul');
        $order->save();
    }

    /**
     * Checks whether order exists
     *
     * @param $uuid
     * @return bool
     */
    public static function checkIfExists($uuid)
    {
        $order = Order::where('unique_id', '=', $uuid)->get();

        if (count($order)) {
            return true;
        }

        return false;
    }

    /**
     * Calculates Order total
     *
     * @param $orderID
     * @return int
     */
    public static function calculateOrderTotal($orderID)
    {
        $orderItems = OrderItem::where('order_id', '=', $orderID)->get();

        $total = 0;
        foreach ($orderItems as $orderItem) {
            $total += $orderItem->subtotal;
        }

        return $total;
    }

    /**
     * Lists seats in the Order.
     *
     * @param $orderID
     * @return mixed
     */
    public static function listSeats($orderID)
    {
        $seats = OrderItem::where([
            ['type', '=', 'seat'],
            ['order_id', '=', $orderID]
        ])->get();

        return $seats;
    }

    /**
     * Adds hotel to Order.
     *
     * @param $uuid
     * @param $request
     */
    public static function updateWithHotelOrder($uuid, $request)
    {
        OrderItem::createHotelItems($uuid, $request);

        $order = Order::where('unique_id', '=', $uuid)->first();

        $order->total = Order::calculateOrderTotal($order->id);
        $order->status = 'added-hotel';
        $order->updated_at = Carbon::now('Europe/Istanbul');
        $order->save();
    }
}
