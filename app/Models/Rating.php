<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table="applytab_rating";

    protected $fillable=[
        'order_id',
        "company_id",
        "services_rating",
        "company_rating",
        "comment"
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order','order_id','order_id');
    }
}
