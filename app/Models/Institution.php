<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $table = 'institution_list';
    public $timestamps = false;

    public function jobs()
    {
        return $this->hasMany('App\Models\JobPost','institution_id');
    }
}
