<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodResource extends JsonResource
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
            'type' => (string)$this->type ?? "",
            'card_holder_name' => (string)$this->card_holder_name ?? "",
            'card_number' => (string)$this->card_number ?? "",
            // 'cvv' => (string)$this->cvv ?? "",
            'expiry_date' => (string)$this->expiry_date ?? "",
        ];
    }
}
