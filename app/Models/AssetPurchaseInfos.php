<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetPurchaseInfos extends Model
{
    protected $table = 'asset_purchase_infos';
    
    protected $fillable = [
        'asset_id',
        'vendor_name',
        'invoice_date',
        'invoice_no',
        'purchase_date',
        'purchase_price',
        'is_self_owned',
        'end_of_life',
        'asset_po_number',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}
