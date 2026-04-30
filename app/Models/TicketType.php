<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    protected $table = 'ticket_types';
    
    protected $fillable = [
        'ticket_type',
        'category_id',
        'expected_tat',
        'activity_type',
        'duration_type',
        'reason',
        'location_id',
        'role_type',
        'reopen_allowed',
        'otp_required',
        'generate_email',
        'change_asset_status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); 
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id'); 
    }
}
