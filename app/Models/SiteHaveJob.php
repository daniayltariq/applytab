<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteHaveJob extends Model
{
    protected $primaryKey = null;
    protected $table="sites_have_jobs";
    public $timestamps = false;

    public function site()
    {
        return $this->belongsTo('App\Models\Site','sites_id');
    }

    public function job()
    {
        return $this->belongsTo('App\Models\JobPost','jobs_id');
    }
}
