<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusCategory extends Model
{
    protected $table = 'status_categories';
    
    protected $fillable = [
        'status_id',
        'category_id',
    ];
}
