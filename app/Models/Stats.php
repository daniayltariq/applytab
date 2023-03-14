<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Stats extends Model
{

    protected $table = 'applytab_stats';
    public $timestamps = ["created_at"]; 
    const UPDATED_AT = null;
    
    public function job()
    {
        return $this->belongsTo('App\Models\JobPost','job_id');
    }

    public function getSourceAttribute()
    {
        return $this->attributes['source'] ? parse_url($this->attributes['source'])['scheme'].'://'.parse_url($this->attributes['source'])['host'] : '';
    }
}
