<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyService extends Model
{
	protected $table = 'company_services';

	protected $fillable = [
	    'company_id','type', 'service', 'price', 'quantity', 'workers', 'service_time', 'visit_duration', 'description'
	];

    public function company()
	{
	    return $this->belongsTo('App\Models\CompanyProfile', 'company_id');
	}

	// service
	public function service_data()
	{
	    return $this->belongsTo('App\Models\Category', 'service');
	}

	// service emp relation
	public function emps_rel()
	{
	    return $this->hasMany('App\Models\ServiceEmployee', 'cs_id');
	}

	// service employees
	public function employees()
	{
	    $emp=ServiceEmployee::where('cs_id',$this->id)->get();
		return $emp;
	}

}
