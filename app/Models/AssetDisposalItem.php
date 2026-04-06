<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetDisposalItem extends Model
{
    protected $table = 'asset_disposal_items';
    
    protected $fillable = [
        'asset_disposal_id',
        'asset_id',
        'sold_value',
        'purchase_price',
        'price_difference',
        'location_id',
        'sub_location_id',
    ];
}
