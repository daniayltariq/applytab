<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyEmployee extends Model
{
    use SoftDeletes;
    protected $table="company_employees";

    protected $fillable=[
        'user_id',
        "company_id",
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    
    public function company()
    {
        return $this->belongsTo('App\Models\CompanyProfile','company_id');
    }

    public function service_employee()
    {
        return $this->hasMany('App\Models\ServiceEmployee','ce_id');
    }
}
