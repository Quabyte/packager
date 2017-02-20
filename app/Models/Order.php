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

    public static function updateOrder($data, $uuid)
    {
        $order = Order::where('unique_id', '=', $uuid)->first();

        OrderItem::createItems($data->items, $order->id);

        $order->total = Order::calculateOrderTotal($order->id);
        $order->updated_at = Carbon::now('Europe/Istanbul');
        $order->save();
    }

    public static function checkIfExists($uuid)
    {
        $order = Order::where('unique_id', '=', $uuid)->get();

        if (count($order)) {
            return true;
        }

        return false;
    }

    public static function calculateOrderTotal($orderID)
    {
        $orderItems = OrderItem::where('order_id', '=', $orderID)->get();

        $total = 0;
        foreach ($orderItems as $orderItem) {
            $total += $orderItem->subtotal;
        }

        return $total;
    }

    public static function listSeats($orderID)
    {
        $seats = OrderItem::where([
            ['type', '=', 'seat'],
            ['order_id', '=', $orderID]
        ])->get();

        return $seats;
    }
}
