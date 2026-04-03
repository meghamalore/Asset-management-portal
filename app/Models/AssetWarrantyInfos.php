<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetWarrantyInfos extends Model
{
    protected $table = 'asset_warranty_infos';
    
    protected $fillable = [
        'asset_id',
        'amc_vendor',
        'warranty_vendor',
        'insurance_start_date',
        'insurance_end_date',
        'amc_start_date',
        'amc_end_date',
        'warranty_start_date',
        'warranty_end_date',
    ];
}
