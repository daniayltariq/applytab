<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    const CREATED_AT = 'post_date';
    
    protected $table="job_type";

}
