<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusSubCategory extends Model
{
    protected $table = 'status_sub_categories';
    
    protected $fillable = [
        'status_id',
        'sub_category_id',
    ];
}
