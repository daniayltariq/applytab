<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyCategory extends Model
{
    protected $table="company_category";

    protected $fillable=[
        "company_id",
        "category_id",
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\UserCompany','company_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }
  
}
