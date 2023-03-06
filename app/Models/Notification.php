<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'applytab_notifications';
    protected $fillable = ['seen'];

    protected $casts = [
        'object' => 'array',
    ];

}
