<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class Seat extends Model
{
    protected $table = 'seats';

    protected $fillable = [
        'category_id',
        'order_id',
        'uuid',
        'zone',
        'row',
        'number',
        'status',
    ];

    public function priceCategory()
    {
        return $this->belongsTo('App\Models\PriceCategory', 'id', 'category_id');
    }

    /**
     * Determines whether given seats are available or not.
     *
     * @param $data
     * @return bool
     */
    public static function checkIfSeatsAvailable($data)
    {
        $notAvailableSeats = [];

        foreach ($data->items as $seatData) {
            $seat = Seat::where('uuid', '=', $seatData['uuid'])->first();

            if ($seat->status !== 'AV') {
                array_push($notAvailableSeats, $seat->uuid);
            }
        }

        if (count($notAvailableSeats)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Determines whether the given seat belongs to current User.
     *
     * @param Seat $seat
     * @return bool
     */
    public static function checkIfTheOwnerIsCurrentUser(Seat $seat)
    {
        $uuid = Cookie::get('uuid');

        $order = Order::where('unique_identifier', '=', $uuid)->first();

        if (count($order) && $seat->order_id == $order->id) {
            return true;
        }

        return false;
    }

    public static function releaseSeats($seats)
    {
        foreach ($seats as $seat)
        {
            $seat->status = 'AV';
            $seat->updated_at = Carbon::now('Europe/Istanbul');
            $seat->save();
        }

        static::generateNewJSON($seats);
    }

    public static function generateNewJSON($seats)
    {
        $affectedZones = [];

        foreach ($seats as $seat) {
            if (!in_array($seat->zone, $affectedZones)) {
                array_push($affectedZones, $seat->zone);
            }
        }

        foreach ($affectedZones as $zone) {
            static::updateJSONFileOf($zone);
        }
    }

    public static function updateJSONFileOf($zone)
    {
        $seatsCollection = Seat::where('zone', '=', $zone)->get();

        $seats = $seatsCollection->toArray();

        $newObjects = [
            'objects' => []
        ];

        $currentObjects = Storage::get('seatbit/zones/z' . $zone . '.json');
        $decoded = json_decode($currentObjects, true);

        for ($i = 0; $i < sizeof($seats); $i++) {

            if ($seats[$i]['status'] === 'AV') {
                $fill = '#3aa99e';
            } else {
                $fill = '#526069';
            }

            if ($seats[$i]['category_id'] != null) {
                $category = PriceCategory::where('id', '=', $seats[$i]['category_id'])->first();
                $priceCategory = $category->price;
                $categoryColor = '#' . $category->color;
            } else {
                $priceCategory = null;
                $categoryColor = '#526069';
            }

            array_push($newObjects['objects'], [
                'type' => 'seat',
                'originX' => 'left',
                'originY' => 'top',
                'left' => $decoded['objects'][$i]['left'],
                'top' => $decoded['objects'][$i]['top'],
                'width' => 20,
                'height' => 20,
                'fill' => $fill,
                'stroke' => $fill,
                'strokeWidth' => 3,
                'strokeDashArray' => null,
                'strokeLineCap' => 'butt',
                'strokeLineJoin' => 'miter',
                'strokeMiterLimit' => 10,
                'scaleX' => 1,
                'scaleY' => 1,
                'angle' => 0,
                'flipX' => false,
                'flipY' => false,
                'opacity' => 1,
                'shadow' => null,
                'visible' => true,
                'clipTo' => null,
                'backgroundColor' => "",
                'fillRule' => 'nonzero',
                'globalCompositeOperation' => 'source-over',
                'transformMatrix' => null,
                'skewX' => 0,
                'skewY' => 0,
                'radius' => 10,
                'startAngle' => 0,
                'endAngle' => 6.283185307179586,
                'number' => (int)$seats[$i]['number'],
                'row' => (int)$seats[$i]['row'],
                'status' => $seats[$i]['status'],
                'uuid' => $seats[$i]['uuid'],
                'zoneNumber' => (int)$seats[$i]['zone'],
                'price' => (int)$priceCategory,
                'categoryID' => (int)$decoded['objects'][$i]['categoryID'],
                'categoryColor' => $categoryColor
            ]);
        }

        $newJSON = json_encode($newObjects);

        Storage::put('seatbit/zones/z' . $zone . '-prev.json', $currentObjects);
        Storage::put('seatbit/zones/z' . $zone . '.json', $newJSON);
    }

    public static function bookParticularSeatOnDatabase($uuid, $orderID)
    {
        $seat = Seat::where('uuid', '=', $uuid)->first();
        $seat->order_id = $orderID;
        $seat->status = 'TMP';
        $seat->updated_at = Carbon::now('Europe/Istanbul');
        $seat->save();
    }
}
