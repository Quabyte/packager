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
        $order->total = 100;
        $order->currency = 949;
        $order->created_at = Carbon::now('Europe/Istanbul');
        $order->updated_at = Carbon::now('Europe/Istanbul');
        $order->save();

        // Create OrderItems
        OrderItem::createItems($data->items, $order->id);
    }
}
