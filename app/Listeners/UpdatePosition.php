<?php

namespace App\Listeners;

use App\Events\UserTracking;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Stevebauman\Location\Facades\Location;

class UpdatePosition
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param UserTracking $event
     * @return void
     */
    public function handle(UserTracking $event)
    {
        User::where('id', $event->user->id)
            ->update(
                [
                    'latitude' => $event->lat,
                    'longitude' => $event->lon,
                ]);
    }
}
