<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table="sites";

    public function site_jobs()
    {
        return $this->hasMany('App\Models\SiteHaveJob','sites_id');
    }

    /**
     * Sites that belong to the ads.
    */
    public function ads()
    {
        return $this->belongsToMany(Ad::class, 'admanagement_ad_sites', 'site_id', 'ad_id');
    }
    
    public function getSiteNameAttribute($value)
    {
        return preg_replace('#^(https?://)?(www\.)?#i', '', $value);
    }
}
