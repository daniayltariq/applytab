<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable=[
        "order_id",
        "company_id",
        "service_id",
        "se_id",
        "contract_duration",
        "date",
        "ends_at",
        "duration"
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order','order_id');
    }
    
    // relation to company
    public function company()
    {
        return $this->belongsTo('App\Models\CompanyProfile','company_id');
    }

    // relation to service
    public function service()
    {
        return $this->belongsTo('App\Models\CompanyService','service_id');
    }

    // relation to service employee
    public function service_employee()
    {
        return $this->belongsTo('App\Models\ServiceEmployee','se_id');
    }
}
