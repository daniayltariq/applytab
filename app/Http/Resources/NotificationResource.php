<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "type"=> $this->type,
            "from_user_id" => $this->from_user_id,
            "to_user_id" => $this->to_user_id,
            "title"=> $this->title,
            "body"=> $this->body,
            "order_id"=> $this->order,
            "seen"=> $this->seen,
            "created_at"=> $this->created_at
        ];
    }
}
