<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeatController extends Controller
{

    /**
     * Show Zone-Seat view
     *
     * @param $zone
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($zone)
    {
        $path = 'seatbit/zones/z' . $zone . '.json';
        $data = Storage::get($path);

        return view('dashboard.seat.show', compact('data'));
    }

    /**
     * Stores the zone into the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $encoded = json_encode($request->json);
        $decoded = json_decode($encoded, true);

        foreach ($decoded['objects'] as $seatInfo)
        {
            $seat = new Seat();

            if ($seatInfo['categoryID'] === 0) {
                $seat->category_id = null;
            } else {
                $seat->category_id = (integer)$seatInfo['categoryID'];
            }
            $seat->order_id = null;
            $seat->uuid = $seatInfo['uuid'];
            $seat->zone = (integer)$seatInfo['zoneNumber'];
            $seat->row = (integer)$seatInfo['row'];
            $seat->number = (integer)$seatInfo['number'];
            $seat->status = $seatInfo['status'];
            $seat->created_at = Carbon::now('Europe/Istanbul');
            $seat->updated_at = Carbon::now('Europe/Istanbul');
            $seat->save();
        }

        return redirect()->back();
    }

    /**
     * Get Particular Seat Data from Database
     *
     * @param $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSeatData($uuid)
    {
        $seat = Seat::where('uuid', '=', $uuid)->first();

        return response()->json([
            $seat
        ]);
    }
}
