<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table = 'assets';
    
    protected $fillable = [
        'asset_name',
        'asset_code',
        'asset_image',
        'category_id',
        'sub_category_id',
        'sub_location_id',
        'location_id',
        'status_id',
        'cwip_invoice_id',
    ];
}
