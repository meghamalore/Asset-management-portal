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
        return $this->hasMany(Asset::class,'status_id');
    }

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'status_categories',
            'status_id',
            'category_id'
        );
    }

    public function subCategories()
    {
        return $this->belongsToMany(
            SubCategory::class,
            'status_sub_categories',
            'status_id',
            'sub_category_id'
        );
    }
}
