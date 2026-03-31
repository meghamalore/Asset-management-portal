<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubLocation extends Model
{
    protected $table = 'sub_locations';
    
    protected $fillable = [
        'location_id',
        'name',
    ];
}
