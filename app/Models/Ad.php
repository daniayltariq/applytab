<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Ad extends Model
{
    // use LogsActivity;

    protected $table = 'admanagement_ads';

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

    public function ad_sites()
    {
        return $this->hasMany('App\Models\AdSites','ad_id');
    }

    public function ad_stats()
    {
        return $this->hasMany('App\Models\Stats','ad_id');
    }

    public function adSites()
    {
        return $this->belongsToMany(Site::class, 'admanagement_ad_sites', 'ad_id', 'site_id');
    }
}
