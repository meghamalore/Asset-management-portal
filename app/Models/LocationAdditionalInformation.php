<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationAdditionalInformation extends Model
{
    protected $table = 'location_additional_information';
    
    protected $fillable = [
        'location_id',
        'department',
        'users',
    ];
}
