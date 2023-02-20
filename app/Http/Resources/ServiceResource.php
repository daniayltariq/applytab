<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'service' => $this->service_data()->select('id','category_name')->first() ?? "",
            'type' => (string)$this->type ?? "",
            'price' => (string)$this->price ?? "",
            "shift" => (string)$this->shift ?? "",
            'description' => (string)$this->description ?? "",
            'company' => new CompanyResource($this->company),
            'employees' => ServiceEmployeeResource::collection($this->emps_rel),
            'company_rating'=>$this->company->average_rating()
        ];
    }
}
