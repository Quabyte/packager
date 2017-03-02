<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class ConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public $user;

    /**
     * ConfirmationEmail constructor.
     *
     * @param $orderID
     */
    public function __construct($orderID)
    {
        $this->order = Order::where('id', '=', $orderID)->first();
        $this->user = Auth::user();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirmation', compact($this->order, $this->user));
    }
}
