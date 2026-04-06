<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetFinacialInfos extends Model
{
    protected $table = 'asset_finacial_infos';
    
    protected $fillable = [
        'asset_id',
        'capitalization_price',
        'capitalization_date',
        'depreciation_percent',
        'accumulated_depreciation',
        'scrap_value',
        'income_tax_depreciation_percent',
        'end_of_life',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}
