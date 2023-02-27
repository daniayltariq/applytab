<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class JobPost extends Model
{
    use LogsActivity;

    protected $table = 'job';


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

    public function stats()
    {
        return $this->hasMany('App\Models\Stats','job_id');
    }
}
