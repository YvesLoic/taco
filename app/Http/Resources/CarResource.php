<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'color' => $this->color,
            'matricule' => $this->registration_number,
            'model' => $this->model,
            'type' => [
                'name' => $this->type->label,
                'price' => $this->type->amount
            ],
            'user' => [
                'id' => $this->user->id,
                'first_name' => $this->user->first_name,
                'last_name' => $this->user->last_name
            ],
            'pictures' => $this->pictures->pluck('src'),
        ];
    }
}
