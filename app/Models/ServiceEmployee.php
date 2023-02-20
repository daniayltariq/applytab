<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceEmployee extends Model
{
	protected $table = 'service_employees';

	protected $fillable=['cs_id','ce_id','created_at','updated_at'];

    public function service()
	{
	    return $this->belongsTo('App\Models\CompanyService', 'cs_id');
	}

	public function emp()
	{
	    return $this->belongsTo('App\Models\CompanyEmployee', 'ce_id');
	}

	public function user()
	{
	    return $this->belongsTo('App\Models\User', 'user_id');
	}
}
