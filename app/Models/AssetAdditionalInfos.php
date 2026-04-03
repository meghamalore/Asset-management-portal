<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetAdditionalInfos extends Model
{
    protected $table = 'asset_additional_infos';
    
    protected $fillable = [
        'asset_id',
        'condition',
        'brand',
        'model',
        'description',
        'serial_no',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}
