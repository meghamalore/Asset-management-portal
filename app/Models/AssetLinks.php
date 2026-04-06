<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetLinks extends Model
{
    protected $table = 'asset_links';
    
    protected $fillable = [
        'asset_id',
        'linked_asset_id'
    ];
}
