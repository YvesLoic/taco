<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DisplacementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'to' => $this->to,
            'to_lat' => $this->to_lat,
            'to_lon' => $this->to_lon,
            'from' => $this->from,
            'from_lat' => $this->from_lat,
            'from_lon' => $this->from_lon,
            'distance' => $this->distance,
            'price' => $this->price,
            'status' => $this->status,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'client' => [
                'id' => $this->client->id,
                'first_name' => $this->client->first_name,
                'last_name' => $this->client->last_name,
            ],
        ];
    }
}
