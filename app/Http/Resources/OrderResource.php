<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $sub_total = $this->order_items && $this->order_items->service ? $this->order_items->service->price * $this->order_items->duration : 0;
        $total =  $sub_total ? ('550' + $sub_total) : 0;
        return [
            "order_id" => $this->order_id ?? '',
            "total_amount"=> $total ?? '',
            "company" =>$this->order_items->company ?? '',
            "service" =>[
                "id"=>$this->order_items->service->id ?? '',
                "type"=>$this->order_items->service->type ?? '',
                "name"=>$this->order_items->service->service_data->category_name ?? '',
                "shift"=>$this->order_items->service->shift ?? '',
                "duration"=>$this->order_items->service->duration ?? '',
            ],
            "service_employee" =>$this->order_items ? new UserResource($this->order_items->service_employee->emp->user ?? '') : '',
            "order_details" => [
                "nationality" => $this->order_items->service_employee->emp->user->nationalityData->name ?? '',
                "workers" => 1,
                "gender" => $this->order_items->service_employee->emp->user->gender ?? '',
                "shift" =>$this->order_items->service->shift ?? '',
                "duration" =>$this->order_items->duration ?? '',
                "start_from" =>$this->order_items->date ?? '',
            ],
            "price_details" => [
                "price" => $sub_total ?? '',
                "vat" => 550,
                "discount" => 0,
                "order_total" => $total ?? '',
            ],
            "address" => [
                "address" => $this->user_address->address ?? '',
                "city" => $this->user_address->city ?? '',
                "state" => $this->user_address->state ?? '',
                "country" => $this->user_address->country ?? '',
                "zipcode" => $this->user_address->zipcode ?? '',
            ],
            'payment_status' => $this->payment_status ?? '',
            'services_rating'=>$this->ratingg ? $this->ratingg->services_rating : '',
            'company_rating'=>$this->ratingg ? $this->ratingg->company_rating: '',
            /* "payment_method" => [
                "id" => $this->user_pm->id ?? '',
                "type" => $this->user_pm->type ?? '',
                "card_holder_name" => $this->user_pm->card_holder_name ?? '',
                "card_number" => $this->user_pm->card_number ?? '',
                "expiry_date" => $this->user_pm->expiry_date ?? '',
                "cvv" => $this->user_pm->cvv ?? '',
            ], */
        ];
    }
}
