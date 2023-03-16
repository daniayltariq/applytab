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
}
