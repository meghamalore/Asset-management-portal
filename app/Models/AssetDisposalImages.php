<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetDisposalImages extends Model
{
    protected $table = 'asset_files';
    
    protected $fillable = [
        'asset_id',
        'file_path',
    ];
}
