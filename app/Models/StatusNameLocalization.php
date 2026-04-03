<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusNameLocalization extends Model
{
    protected $table = 'status_name_localizations';
    
    protected $fillable = [
        'status_id',
        'status_name',
        'language',
    ];
}
