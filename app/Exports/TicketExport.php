<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TicketExport implements FromCollection, WithHeadings, WithMapping
{
    protected $tickets;

    //  constructor to receive data
    public function __construct($tickets)
    {
        $this->tickets = $tickets;
    }

    //  return collection
    public function collection()
    {
        return $this->tickets;
    }

    //  headings
    public function headings(): array
    {
        return [
            'Ticket Number',
            'Ticket Type',
            'Location',
            'Asset',
            'Assigned To',
            'Ticket Group',
            'Priority',
            'Reported Date',
            'Reported By',
            'Description',
            'Notify Reported By'
        ];
    }

    //  map data
    public function map($ticket): array
    {
        return [
            $ticket->ticket_number,
            $ticket->ticketType->ticket_type ?? '-',
            $ticket->location->name ?? '-',
            $ticket->asset->asset_name ?? '-',
            $ticket->assigned_to ?? '-',
            $ticket->ticket_group ?? '-',
            ucfirst($ticket->priority ?? '-'),
            $ticket->reported_date ?? '-',
            $ticket->reported_by ?? '-',
            $ticket->description ?? '-',
            $ticket->notify_reported_by ? 'Yes' : 'No',
        ];
    }
}