<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class AdSites extends Model
{

    protected $table = 'admanagement_ad_sites';
    // public $timestamps = ["created_at"];
    // const UPDATED_AT = null;

    // public function ad()
    // {
    //     return $this->belongsTo('App\Models\Ad','ad_id');
    // }

}
