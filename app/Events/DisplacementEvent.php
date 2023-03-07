<?php

namespace App\Events;

use App\Http\Resources\DisplacementResource;
use App\Models\Displacement;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DisplacementEvent implements  ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $trip;

    /**
     * Create a new event instance.
     *
     * @param Displacement $trip
     */
    public function __construct(Displacement $trip)
    {
        $this->trip = $trip;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('private.trip');
    }

    public function broadcastAs()
    {
        return 'displacementEvent';
    }

    public function broadcastWith()
    {
        return new DisplacementResource($this->trip);
    }
}
