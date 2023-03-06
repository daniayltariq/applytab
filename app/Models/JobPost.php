<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class JobPost extends Model
{
    // use LogsActivity;

    protected $table = 'jobs';
    public $timestamps = false;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function getStartDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function getEndDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function institution()
    {
        return $this->belongsTo('App\Models\Institution','institution_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\JobType','job_type');
    }

    // public function city()
    // {
    //     return $this->belongsTo('App\Models\City','institution_city');
    // }

    public function country()
    {
        return $this->belongsTo('App\Models\Country','institution_country_id');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State','institution_state_id');
    }

    public function stats()
    {
        return $this->hasMany('App\Models\Stats','job_id');
    }
}
