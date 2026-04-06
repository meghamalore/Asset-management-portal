<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    
    protected $fillable = [
        'status_type',
        'status_name',
        'next_status',
        'hold_pause_activity',
    ];

    public function assets()
    {
        return $this->hasMany(Asset::class, 'status_id');
    }
}
