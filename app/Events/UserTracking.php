<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserTracking
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $lat;
    public $lon;
    public $ip;

    /**
     * Create a new event instance.
     *
     * @param User $_user
     * @param mixed $_lat
     * @param mixed $_lon
     * @param mixed $_ip
     */
    public function __construct(User $_user, $_lat, $_lon, $_ip)
    {
        $this->user = $_user;
        $this->lat = $_lat;
        $this->lon = $_lon;
        $this->ip = $_ip;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
