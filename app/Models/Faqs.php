<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faqs extends Model
{
    protected $table = 'faqs';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'description'];
}
