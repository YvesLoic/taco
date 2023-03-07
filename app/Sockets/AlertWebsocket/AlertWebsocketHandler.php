<?php

namespace App\Sockets\AlertWebsocket;

use App\Http\Resources\AlertResource;
use App\Models\Alert;
use App\Sockets\BaseWebsockeHandler;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;

class AlertWebsocketHandler extends BaseWebsockeHandler
{
    public function onMessage(ConnectionInterface $conn, MessageInterface $msg)
    {
        $payload = collect(json_decode($msg->getPayload(), true));
        $body = $payload->get('alert');
        $alert = Alert::query()->create(
            [
                'content' => $body['content'],
                'type' => $body['type'],
                'displacement_id' => $body['trip_id'],
            ]
        );
        $alert = Alert::query()->with('trip.client')->find($alert->id);
        $conn->send(json_encode(new AlertResource($alert)));
    }
}
