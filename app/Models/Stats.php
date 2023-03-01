<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Stats extends Model
{

    protected $table = 'applytab_stats';

    public function job()
    {
        return $this->belongsTo('App\Models\JobPost','job_id');
    }
}
