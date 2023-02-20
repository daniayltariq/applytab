<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity;
    protected $table="categories";

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function company_services(){
        return $this->hasMany('App\Models\CompanyService','service','id');
    }
}
