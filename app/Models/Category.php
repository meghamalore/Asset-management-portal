<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'is_inventory',
        'is_asset_link',
        'category_code',
        'trafs_duration',
        'trafs_duration_type',
        'cascade',
        'auto_extended',
    ];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }

    public function assets()
    {
        return $this->hasMany(Asset::class, 'category_id');
    }
}
