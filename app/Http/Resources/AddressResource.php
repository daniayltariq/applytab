<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            "name" => $this->name ?? '',
            "city" => $this->city ?? '',
            "state" => $this->state ?? '',
            "country" => $this->country ?? '',
            "zipcode" =>  $this->zipcode ?? '',
            "address" => $this->address ?? '',
            "lat" => $this->lat ?? '',
            "lng" => $this->lng ?? '',
            "icon" =>  $this->icon ?? '',
            "description" => $this->description ?? '',
        ];
    }
}
