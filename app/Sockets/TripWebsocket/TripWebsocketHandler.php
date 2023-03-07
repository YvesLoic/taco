<?php


namespace App\Sockets\TripWebsocket;


use App\Http\Requests\DisplacementRequest;
use App\Http\Resources\DisplacementResource;
use App\Models\Displacement;
use App\Sockets\BaseWebsockeHandler;
use Illuminate\Http\Response;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;

/**
 * @group Trip Sockets
 *
 * Collection des évènements liés aux déplacements.
 */
class TripWebsocketHandler extends BaseWebsockeHandler
{
    /**
     * New Message.
     *
     * Evènement déclenché lors de l'émission d'un déplacement
     *
     * @bodyParam to string addresse de l'user lors de la demande. Example: Mvog Ada
     * @bodyParam to_lat float latitude de l'user lors de la demande. Example: 3,457896
     * @bodyParam to_lon float longitude de l'user lors de la demande. Example: 11,457896
     * @bodyParam from string destination de l'user lors de la demande. Example: Cité U
     * @bodyParam from_lat float latitude de destination de l'user lors de la demande. Example: 3,965241
     * @bodyParam from_lon float longitude de destination l'user lors de la demande. Example: 11,632945
     * @bodyParam distance float distance totale du trajet. Example: 8,06
     * @bodyParam price integer prix total du trajet. Example: 2500
     * @bodyParam status string statut du trajet. Example: pending
     * @bodyParam user_id integer client concerné par le trajet. Example: 1
     *
     * @param ConnectionInterface $conn
     * @param MessageInterface $msg
     * @return Response|mixed
     */
    public function onMessage(ConnectionInterface $conn, MessageInterface $msg)
    {
        $payload = collect(json_decode($msg->getPayload(), true));
        $body = $payload->get('trip');
        $trip = null;
        switch ($body['status']) {
            case 'pending':
                $trip = Displacement::query()->find($body['id']);
                if (!is_null($trip)) {
                    $trip->update(['status' => 'pending', 'car_id' => $body['car_id']]);
                    $trip = Displacement::with(['client', 'car.user'])->find($trip->id);
                    $conn->send(json_encode(new DisplacementResource($trip)));
                }
                $conn->send(json_encode(['data' => 'No data found with id:' . $body['id']]));
                break;
            case 'ongoing':
                $trip = Displacement::query()->find($body['id']);
                if (!empty($trip)) {
                    $trip->update(['status' => 'ongoing']);
                    $trip = Displacement::with(['client', 'car.user'])->find($trip->id);
                    $conn->send(json_encode(new DisplacementResource($trip)));
                }
                $conn->send(json_encode(['data' => 'No data found with id:' . $body['id']]));
                break;
            case 'ended':
                $trip = Displacement::query()->find($body['id']);
                if (!empty($trip)) {
                    $trip->update(['status' => 'ended']);
                    $driver = $trip->car->user;
                    $driver->update(['points' => $driver->points - $trip->price]);
                    $trip = Displacement::with(['client', 'car.user'])->find($trip->id);
                    $conn->send(json_encode(new DisplacementResource($trip)));
                }
                $conn->send(json_encode(['data' => 'No data found with id:' . $body['id']]));
                break;
            default:
                $trip = Displacement::query()->create(
                    [
                        'to' => $body['to'],
                        'to_lat' => $body['to_lat'],
                        'to_lon' => $body['to_lon'],
                        'from' => $body['from'],
                        'from_lat' => $body['from_lat'],
                        'from_lon' => $body['from_lon'],
                        'distance' => $body['distance'],
                        'price' => $body['price'],
                        'status' => $body['status'],
                        'type' => $body['type'],
                        'car_id' => $body['car_id'],
                        'user_id' => $body['user_id'],
                    ]
                );
                $trip = Displacement::with(['client', 'car.user'])->find($trip->id);
                $conn->send(json_encode(new DisplacementResource($trip)));
                break;
        }
    }
}
