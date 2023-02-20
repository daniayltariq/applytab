<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceEmployeeResource extends JsonResource
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
            "id" => $this->id ?? '',
            "company" =>$this->when(Route::is('service.index') && isset($request->type) && $request->type=='stay_in',$this->emp->user->employee_company->company ?? '' ) ,
            "user" => new UserResource($this->emp->user ?? ''),
        ];
    }
}
