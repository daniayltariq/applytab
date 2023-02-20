<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'id' => (string)$this->id ?? "",
            // "user" => $this->user ?? '',
            "company" => $this->name ?? '',
            "email" => $this->email ?? '',
            "phone" => $this->contact ?? '',
            "location" => $this->location ?? '',
            "additional_info" => $this->additional_info ?? '',
            "logo" => $this->logo ?? '',
        ];
    }
}
