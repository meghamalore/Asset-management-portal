<?php

namespace App\Imports;

use App\Models\Ticket;
use App\Models\Location;
use App\Models\Department;
use App\Models\Asset;
use App\Models\User;
use App\Models\TicketType;
use App\Models\TicketStatus;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class TicketImport implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    SkipsOnFailure,
    SkipsEmptyRows
{
    use Importable, SkipsFailures;

    /**
     * Insert Ticket Data
     */
    public function model(array $row)
    {
        $location = Location::where('name', trim($row['location'] ?? ''))->first();

        $department = Department::where('name', trim($row['department'] ?? ''))->first();

        $asset = Asset::where('asset_name', trim($row['asset'] ?? ''))->first();

        $user = User::where('name', trim($row['assigned_to'] ?? ''))->first();

        $ticketType = TicketType::where('ticket_type', trim($row['ticket_type'] ?? ''))->first();

        $ticketStatus = TicketStatus::where('status', trim($row['ticket_status'] ?? ''))->first();

        return new Ticket([

            'ticket_number'    => 'TKT-' . now()->format('Ymd') . rand(100, 999),

            // 'parent_ticket' => $row['parent_ticket'] ?? null,

            'ticket_type_id'   => $ticketType->id ?? null,

            'ticket_status_id' => $ticketStatus->id ?? null,

            'location_id'      => $location->id ?? null,

            'asset_id'         => $asset->id ?? null,

            'department_id'    => $department->id ?? null,

            'assigned_to'      => $user->id ?? null,

            'ticket_group'     => trim($row['ticket_group'] ?? ''),

            'priority'         => trim($row['priority'] ?? ''),

            'reported_date'    => $row['reported_date'] ?? null,

            'reported_by'      => trim($row['reported_by'] ?? ''),

            'description'      => trim($row['description'] ?? ''),

            // 'notify_reported_by' => $row['notify_reported_by'] ?? null,

        ]);
    }

    /**
     * Prepare Data Before Validation
     */
    public function prepareForValidation($data, $index)
    {
        return [

            'ticket_type' => trim($data['ticket_type'] ?? ''),

            'ticket_status' => trim($data['ticket_status'] ?? ''),

            'location' => trim($data['location'] ?? ''),

            'asset' => trim($data['asset'] ?? ''),

            'department' => trim($data['department'] ?? ''),

            'assigned_to' => trim($data['assigned_to'] ?? ''),

            'ticket_group' => trim($data['ticket_group'] ?? ''),

            'priority' => trim($data['priority'] ?? ''),

            'reported_by' => trim($data['reported_by'] ?? ''),

            'description' => trim($data['description'] ?? ''),

        ];
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        return [

            '*.ticket_type' => 'required|exists:ticket_types,ticket_type',

            '*.ticket_status' => 'required|exists:ticket_statuses,status',

            '*.location' => 'required|exists:locations,name',

            '*.asset' => 'required|exists:assets,asset_name',

            '*.department' => 'required|exists:departments,name',

            '*.assigned_to' => 'required|exists:users,name',

            '*.ticket_group' => 'required',

            '*.priority' => 'required',

            '*.reported_by' => 'required',

            '*.description' => 'required',

        ];
    }

    /**
     * Custom Validation Messages
     */
    public function customValidationMessages()
    {
        return [

            '*.ticket_type.required' => 'Ticket Type is required',

            '*.ticket_type.exists' => 'Ticket Type not found',

            '*.ticket_status.required' => 'Ticket Status is required',

            '*.ticket_status.exists' => 'Ticket Status not found',

            '*.location.required' => 'Location is required',

            '*.location.exists' => 'Location not found',

            '*.asset.required' => 'Asset is required',

            '*.asset.exists' => 'Asset not found',

            '*.department.required' => 'Department is required',

            '*.department.exists' => 'Department not found',

            '*.assigned_to.required' => 'Assigned User is required',

            '*.assigned_to.exists' => 'Assigned User not found',

            '*.ticket_group.required' => 'Ticket Group is required',

            '*.priority.required' => 'Priority is required',

            '*.reported_by.required' => 'Reported By is required',

            '*.description.required' => 'Description is required',

        ];
    }
}