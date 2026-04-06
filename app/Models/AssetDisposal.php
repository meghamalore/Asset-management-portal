<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetDisposal extends Model
{
    protected $table = 'asset_disposals';
    
    protected $fillable = [
        'reason',
        'discard_date',
        'vendor_name',
        'remark',
        'tax_group',
    ];
}
