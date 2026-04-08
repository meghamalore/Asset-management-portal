<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class AssetTransfer extends Model
{
    protected $table = 'asset_transfers';
    protected $fillable = [
        'asset_id',
        'from_location_id',
        'to_location_id',
        'from_sub_location_id',
        'to_sub_location_id',
        'transfer_status',
        'transferred_to',
        'allotted_upto',
        'transfer_cc',
        'remarks',
        'file_paths',
        'transferred_by',
        'transferred_at'
    ];
    
    protected $casts = [
        'allotted_upto' => 'date',
        'transferred_at' => 'datetime',
        'file_paths' => 'array' // If storing as JSON
    ];
    // Relationships
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}