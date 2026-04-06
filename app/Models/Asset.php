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

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); // FK in assets table
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id'); // FK in assets table
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id'); // FK in assets table
    }

    public function additionalInfo()
    {
        return $this->hasOne(AssetAdditionalInfos::class, 'asset_id');
    }

    public function purchaseInfo()
    {
        return $this->hasOne(AssetPurchaseInfos::class, 'asset_id');
    }

    public function finacialInfos()
    {
        return $this->hasOne(AssetFinacialInfos::class, 'asset_id');
    }

    public function assetallotedInfos()
    {
        return $this->hasOne(AssetAllotedInfos::class, 'asset_id');
    }

    public function assetwarrantyInfos()
    {
        return $this->hasOne(AssetWarrantyInfos::class, 'asset_id');
    }
}
