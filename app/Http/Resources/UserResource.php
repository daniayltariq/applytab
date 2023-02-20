<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if(!empty($this->email_verified_at)){
            $email_verified = true;
        }else{
            $email_verified = false;
        }
        if($this->hasRole('superadmin')){
            $role = 'super_admin';
        }elseif($this->hasRole('endUser')){
            $role = 'endUser';
        }else{
            $role = 'supplier';
        }
        return [
            "id" => $this->id ?? "",
            "first_name" =>$this->first_name ?? "",
            "last_name" =>$this->last_name ?? "",
            "phone" => $this->phone ?? "",
            "email" => $this->email ?? "",
            "date_of_birth" => $this->date_of_birth ?? "",
            "profile_image" => $this->profile_image ?? "",
            "role" => $role ?? "",
            "gender" => $this->gender ?? "",
            "nationality"=>$this->nationalityData()->select('id','name')->first() ?? ''
            // "company_profile" => $this->company_profile ?? null,
            // "email_verified" => $email_verified ?? false,
        ];
        return parent::toArray($request);
    }
}
