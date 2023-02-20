<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_status';
    protected $fillable=[
        "order_id",
        "status",
    ];
    
    public function order()
    {
        return $this->belongsTo('App\Models\Order','order_id');
    }
}
