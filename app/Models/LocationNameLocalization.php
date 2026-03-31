<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationNameLocalization extends Model
{
    protected $table = 'location_name_localizations';
    
    protected $fillable = [
        'location_id',
        'location_name',
        'language',
    ];
}
