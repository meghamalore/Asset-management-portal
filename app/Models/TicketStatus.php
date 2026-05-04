<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{   
    protected $table = 'ticket_statuses';
    
    protected $fillable = [
        'status',
        'auto_close_hours',
        'is_default',
        'edit_based_on',
        'auto_checkout',
        'tat_count'
    ];
}
