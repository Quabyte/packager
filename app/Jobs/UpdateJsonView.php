<?php

namespace App\Jobs;

use App\Models\Seat;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateJsonView implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 4;

    public $seats;

    /**
     * UpdateJsonView constructor.
     *
     * @param Collection $seats
     */
    public function __construct(Collection $seats)
    {
        $this->seats = $seats;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Seat::generateNewJSON($this->seats);
    }
}
