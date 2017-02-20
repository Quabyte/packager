<?php

namespace App\Models;

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

            if ($item->type === "seat") {
                $item->quantity = 1;
            } else {
                $item->quantity = $itemData['quantity'];
            }

            $item->uuid = $itemData['uuid'];
            $item->unit_price = $itemData['price'];
            $item->subtotal = $itemData['price'] * $item->quantity;
            $item->order_id = $order;
            $item->created_at = Carbon::now('Europe/Istanbul');
            $item->updated_at = Carbon::now('Europe/Istanbul');
            $item->save();
        }
    }
}
