<?php

namespace App\Imports;

use App\Models\Ticket;
use App\Models\Category;
use App\Models\Location;
use App\Models\Department;
use App\Models\Asset;
use App\Models\User;
use App\Models\TicketType;
use App\Models\TicketStatus;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class TicketImport implements ToCollection, WithHeadingRow, WithValidation,  SkipsOnFailure
{
    use SkipsFailures;

    public function collection(Collection $rows)
    {
        $tickets = [];

        foreach ($rows as $row) {
    
            $location = Location::where('name', $row['location'] ?? null)->first();

            $department = Department::where('name', $row['department'] ?? null)->first();

            $asset = Asset::where('asset_name', $row['asset'] ?? null)->first();

            $user = User::where('name', $row['assigned_to'] ?? null)->first();

            $ticketType = TicketType::where('ticket_type', $row['ticket_type'] ?? null)->first();

            $ticketStatus = TicketStatus::where('status', $row['ticket_status'] ?? null)->first();

            $tickets[] = [
                'ticket_number'      => $row['ticket_number'] ?? null,
                // 'parent_ticket'   => $row['parent_ticket'] ?? null,

                'ticket_type_id'     => $ticketType->id ?? null,
                'ticket_status_id'   => $ticketStatus->id ?? null,

                'location_id'        => $location->id ?? null,
                'asset_id'           => $asset->id ?? null,
                'department_id'      => $department->id ?? null,
                'assigned_to'        => $user->id ?? null,

                'ticket_group'       => $row['ticket_group'] ?? null,
                'priority'           => $row['priority'] ?? null,
                'reported_date'      => $row['reported_date'] ?? null,
                'reported_by'        => $row['reported_by'] ?? null,
                'description'        => $row['description'] ?? null,
                // 'notify_reported_by' => $row['notify_reported_by'] ?? null,

                'created_at'         => now(),
                'updated_at'         => now(),
            ];
        }

        Ticket::insert($tickets);

    }

    public function rules(): array
    {
        return [
            '*.ticket_number'    => 'nullable|string|max:255',
            '*.parent_ticket'    => 'nullable|string|max:255',
            '*.ticket_type_id'   => 'nullable|integer',
            '*.ticket_status_id' => 'nullable|integer',
            '*.user_name'    => 'nullable|string|max:255',
            '*.location_id'      => 'nullable|integer',
            '*.asset_id'         => 'nullable|integer',
            '*.department_id'    => 'nullable|integer',
            '*.assigned_to'      => 'nullable|integer',
            '*.ticket_group'     => 'nullable|string|max:255',
            '*.priority'         => 'nullable|string|max:100',
            '*.description'      => 'nullable|string',
            // '*.notify_reported_by' => 'nullable',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.ticket_number.required'      => 'Ticket Number is required.',
            '*.parent_ticket.required'      => 'Parent Ticket is required.',
            '*.ticket_type_id.required'     => 'Ticket Type ID is required.',
            '*.ticket_status_id.required'   => 'Ticket Status ID is required.',
            '*.user_name.required'          => 'User Name is required.',
            '*.location_id.required'        => 'Location ID is required.',
            '*.asset_id.required'           => 'Asset ID is required.',
            '*.department_id.required'      => 'Department ID is required.',
            '*.assigned_to.required'        => 'Assigned To is required.',
            '*.ticket_group.required'       => 'Ticket Group is required.',
            '*.priority.required'           => 'Priority is required.',
            '*.description.required'        => 'Description is required.',
            '*.notify_reported_by.required' => 'Notify Reported By is required.',
        ];
    }
}