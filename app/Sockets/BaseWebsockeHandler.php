<?php


namespace App\Sockets;

use App\Exceptions\UserException;
use App\Models\User;
use BeyondCode\LaravelWebSockets\Apps\App;
use BeyondCode\LaravelWebSockets\QueryParameters;
use BeyondCode\LaravelWebSockets\WebSockets\Exceptions\UnknownAppKey;
use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;

abstract class BaseWebsockeHandler implements MessageComponentInterface
{

    protected function verifyAppKey(ConnectionInterface $connection)
    {
        $appKey = QueryParameters::create($connection->httpRequest)->get('appKey');
        if (!$app = App::findByKey($appKey)) {
            throw new UnknownAppKey($appKey);
        }
        $connection->app = $app;
        return $this;
    }

    protected function verifyUserId(ConnectionInterface $connection)
    {
        $user_id = QueryParameters::create($connection->httpRequest)->get('user_id');
        if (!$user = User::query()->find($user_id)) {
            throw new UserException('User with Id:' . $user_id . ' not found!');
        }
        return $user;
    }

    protected function generateSocketId(ConnectionInterface $connection)
    {
        $un = rand(1, 1000000000);
        $deux = rand(1, 1000000000);
//        $socketId = $un.'.'.$deux;
        $socketId = sprintf('%d.%d', $un, $deux);
        $connection->socketId = $socketId;
        return $this;
    }

    function onOpen(ConnectionInterface $conn)
    {
        $this->verifyAppKey($conn)
            ->generateSocketId($conn);
        $user = $this->verifyUserId($conn);
        $conn->send(json_encode(
            [
                "user" => [
                    "id" => $user->id,
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name,
                    "phone" => $user->phone,
                    "latitude" => $user->latitude,
                    "longitude" => $user->longitude,
                    "role" => $user->roles->pluck('name'),
                ]
            ]
        ));
    }

    function onClose(ConnectionInterface $conn)
    {

        $user = $this->verifyUserId($conn);
        $conn->send(json_encode(
            [
                "user" => [
                    "id" => $user->id,
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name,
                    "phone" => $user->phone,
                    "latitude" => $user->latitude,
                    "longitude" => $user->longitude,
                    "role" => $user->roles->pluck('name'),
                ]
            ]
        ));
    }

    function onError(ConnectionInterface $conn, Exception $e)
    {
        dump("Error: " . $e->getMessage());
        $conn->send(json_encode($e->getMessage()));
    }

    public function onMessage(ConnectionInterface $conn, MessageInterface $msg)
    {
        // TODO: Implement onMessage() method.
    }
}
