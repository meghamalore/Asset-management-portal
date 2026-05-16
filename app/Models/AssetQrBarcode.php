<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetQrBarcode extends Model
{
    protected $table = 'asset_qr_barcodes';
    protected $fillable = [
        'asset_id',
        'asset_code',
        'qr_code',
        'barcode',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}
