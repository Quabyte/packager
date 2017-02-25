<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\Seat;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ReleaseSeats implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;

    public $orderID;

    /**
     * ReleaseSeats constructor.
     *
     * @param $orderID
     */
    public function __construct($orderID)
    {
        $this->orderID = $orderID;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $order = Order::where('id', '=', $this->orderID)->first();

        if ($order->status !== 'completed')
        {
            $seats = Seat::where('order_id', '=', $order->id)->get();

            Seat::releaseSeats($seats);

        }
    }
}
