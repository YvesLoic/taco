<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class AlertResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'type' => $this->type,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
            'trip_id' => $this->displacement_id,
            'client' => [
                'id' => $this->trip->client->id,
                'first_name' => $this->trip->client->first_name,
                'last_name' => $this->trip->client->last_name,
                'picture' => $this->trip->client->picture,
            ],
        ];
    }
}
