<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyProfileResource extends JsonResource
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
            "user" => $this->user ?? '',
            "shop_name" => $this->shop_name ?? '',
            "shop_contact" => $this->shop_contact ?? '',
            "shop_location" => $this->shop_location ?? '',
            'additional_info' => (string)$this->additional_info ?? "",
            "shop_logo" => $this->shop_logo ?? '',
            "reg_certificate" => $this->reg_certificate ?? '',
        ];
    }
}
