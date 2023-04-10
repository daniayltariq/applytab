<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $table="admanagement_slots";

    /**
     * Sites that belong to the ads.
    */
    public function ads()
    {
        return $this->belongsToMany(Ad::class, 'admanagement_ad_sites', 'slot_id', 'ad_id');
    }
}
