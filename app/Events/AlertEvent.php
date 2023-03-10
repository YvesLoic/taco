<?php

namespace App\Events;

use App\Models\Alert;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AlertEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $_alert;

    /**
     * Create a new event instance.
     *
     * @param mixed $alert
     */
    public function __construct(Alert $alert)
    {
        $this->_alert = $alert;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('public.alert.1');
    }

    public function broadcastAs()
    {
        return 'alertEvent';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->_alert->id,
            'created_at' => $this->_alert->created_at,
            'content' => $this->_alert->content,
            'type' => $this->_alert->type,
            'displacement' => $this->_alert->displacement,
        ];
    }
}
