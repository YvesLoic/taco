<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserResource extends JsonResource
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
            "distance" => $this->distance,
            "email" => $this->email,
            "first_name" => $this->first_name,
            "id" => $this->id,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "last_name" => $this->last_name,
            "phone" => $this->phone,
            "points" => $this->points,
            "picture" => $this->picture == null
                ?:
                $request->getSchemeAndHttpHost() . '/assets/images/users/' . $this->picture,
            "rule" => $this->roles->pluck('name'),
        ];
    }
}
