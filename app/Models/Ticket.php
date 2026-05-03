<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    
    protected $fillable = [
        'ticket_number',
        'parent_ticket',
        'ticket_type_id',
        'customer_name',
        'location_id',
        'asset_id',
        'department_id',
        'assigned_to',
        'ticket_group',
        'priority',
        'reported_date',
        'reported_by',
        'description',
        'notify_reported_by',
    ];

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

}
