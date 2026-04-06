<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $fillable = [
        'name',
        'location_code',
        'latitude',
        'longitude',
        'description',
        'is_inventory',
    ];

    public function assets()
    {
        return $this->hasMany(Asset::class, 'location_id');
    }
}
