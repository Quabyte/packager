<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $seats = Seat::where('order_id', '=', $orderID)->get();

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

    public static function assignUserId($order)
    {
        $order->user_id = Auth::id();
        $order->save();
    }

    public static function preparePayment($order)
    {
        $paymentDetails = [
            'clientid' => '600697513',
            'amount' => $order->total,
            'oid' => $order->unique_id,
            'okUrl' => 'http://packager.dev/confirmation',
            'failUrl' => 'http://packager.dev/confirmation',
            'islemtipi' => 'Auth',
            'taksit' => '',
            'rnd' => $order->unique_id,
            'storetype' => '3d_pay_hosting',
            'refreshtime' => '5',
            'lang' => 'tr'
        ];

        $hash = static::prepareHash($paymentDetails);

        $paymentDetails['hash'] = $hash;

        return $paymentDetails;
    }

    protected static function prepareHash($paymentDetails)
    {
        $hashstr = $paymentDetails['clientid'] .
                   $paymentDetails['oid'] .
                   $paymentDetails['amount'] .
                   $paymentDetails['okUrl'] .
                   $paymentDetails['failUrl'] .
                   $paymentDetails['islemtipi'] .
                   $paymentDetails['taksit'] .
                   $paymentDetails['rnd'] .
                   'KUTU7513';

        return $hash = base64_encode(pack('H*',sha1($hashstr)));
    }

    public static function confirmed(Request $request)
    {
        $hashparams = $request->HASHPARAMS;
        $hashparamsval = $request->HASHPARAMSVAL;
        $hashparam = $request->HASH;
        $storeKey= 'KUTU7513';
        $paramsval='';
        $index1=0;
        $index2=0;

        while($index1 < strlen($hashparams))
        {
            $index2 = strpos($hashparams,':',$index1);
            $vl = $_POST[substr($hashparams, $index1, $index2- $index1)];

            if ($vl == null) {
                $vl = '';
            }

            $paramsval = $paramsval . $vl;
            $index1 = $index2 + 1;
        }

        $storeKey = 'KUTU7513';
        $hashval = $paramsval.$storeKey;

        $hash = base64_encode(pack('H*',sha1($hashval)));

        if($paramsval != $hashparamsval || $hashparam != $hash) {
            DB::table('failed_payments')->insert([
                'uuid' => $request->oid,
                'reason' => 'Hash not matched!',
                'created_at' => Carbon::now('Europe/Istanbul')
            ]);
            return false;
        }

        $mdStatus = $request->mdStatus;
        $ErrMsg = $request->ErrMsg;

        if($mdStatus == 1 || $mdStatus == 2 || $mdStatus == 3 || $mdStatus == 4)
        {
            $finalResponse = $request->Response;

            if ($finalResponse == 'Approved')
            {
                return true;
            }
            else
            {
                DB::table('failed_payments')->insert([
                    'uuid' => $request->oid,
                    'reason' => $ErrMsg,
                    'created_at' => Carbon::now('Europe/Istanbul')
                ]);
                return false;
            }

        }
        else
        {
            DB::table('failed_payments')->insert([
                'uuid' => $request->oid,
                'reason' => '3D is not approved!',
                'created_at' => Carbon::now('Europe/Istanbul')
            ]);
            return false;
        }
    }

    public static function checkStillAvailable(Request $request)
    {
        $order = Order::where('unique_id', '=', $request->oid)->first();

        if ($order->status === 'terminated') {
            return false;
        } else {
            return true;
        }
    }
}
