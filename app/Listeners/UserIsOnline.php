<?php

namespace App\Listeners;

use App\Events\UserTracking;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class UserIsOnline
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
        $expireAt = now()->addMinutes(1); // we will consider that after 1 minute user automatically offline
        Cache::put('user-is-online-', $event->user->id, $expireAt);

        User::where('id', $event->user->id)->update(['last_seen' => now()]);
    }
}
