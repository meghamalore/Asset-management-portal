<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetAllotedInfos extends Model
{
    protected $table = 'asset_alloted_infos';
    
    protected $fillable = [
        'asset_id',
        'department',
        'transferred_to',
        'allotted_upto',
        'remarks',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}
