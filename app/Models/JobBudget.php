<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobBudget extends Model
{
    protected $table="applytab_job_budget";

    protected $fillable=[
        'job_id',
        'site_id',
        'budget'
    ];

    public $timestamps = false;
    
    public function job()
    {
        return $this->belongsTo('App\Models\JobPost','job_id');
    }

    public function site()
    {
        return $this->belongsTo('App\Models\Site','site_id');
    }
}
