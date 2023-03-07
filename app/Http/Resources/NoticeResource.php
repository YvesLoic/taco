<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use JsonSerializable;

class NoticeResource extends JsonResource
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
            'note' => $this->note,
            'sender' => [
                'id' => $this->sender->id,
                'name' => Str::title($this->sender->first_name . ' ' . $this->sender->last_name),
            ],
            'receiver' => [
                'id' => $this->receiver->id,
                'name' => Str::title($this->receiver->first_name . ' ' . $this->receiver->last_name),
            ],
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
