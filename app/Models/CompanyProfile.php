<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $table="company_profile";

    protected $fillable=[
        'user_id',
        'name',
        'email',
        'contact',
        'location',
        'city',
        'state',
        'country',
        'logo',
    ];
    
    public function getLogoAttribute($value)
    {
        return $value ? (url('/').'/storage/uploads/company_profile/' . $value) : "";
    }
    
    public function getRegCertificateAttribute($value)
    {
        return $value ? (url('/').'/storage/uploads/company_profile/' . $value) : "";
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function emp()
    {
        return $this->hasMany('App\Models\CompanyEmployee','company_id');
    }

    //services
    public function services()
    {
        return $this->hasMany('App\Models\CompanyService','company_id');
    }

    // get companies coupons
    
    public function coupons()
    {
        $coupons=Coupon::where('companies','LIKE','%'.$this->id.'%')->get();
        return $coupons;
        //return $this->belongsTo('App\Sku','sku_id');
    }

    //get company rating
    public function rating_data()
    {
        return $this->hasMany('App\Models\Rating','company_id');
    }
    
    public function orders()
    {
        return $this->hasMany('App\Models\OrderItem','company_id');
    }

    //average rating
    public function average_rating()
    {
        $ratings=$this->rating_data;
        $average=$ratings->count() ? number_format($this->rating_data->sum('company_rating')/$ratings->count()) : "0";
        return $average;
    }
}
