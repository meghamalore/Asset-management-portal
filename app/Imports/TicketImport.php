<?php

namespace App\Imports;

use App\Models\Ticket;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\Importable;

class TicketImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public function model(array $row)
    {
        return new Ticket([
            'ticket_number'      => $row['ticket_number'] ?? null,
            'parent_ticket'      => $row['parent_ticket'] ?? null,
            'ticket_type_id'     => $row['ticket_type_id'] ?? null,
            'ticket_status_id'   => $row['ticket_status_id'] ?? null,
            'customer_name'      => $row['customer_name'] ?? null,
            'location_id'        => $row['location_id'] ?? null,
            'asset_id'           => $row['asset_id'] ?? null,
            'department_id'      => $row['department_id'] ?? null,
            'assigned_to'        => $row['assigned_to'] ?? null,
            'ticket_group'       => $row['ticket_group'] ?? null,
            'priority'           => $row['priority'] ?? null,
            'reported_date'      => $row['reported_date'] ?? null,
            'reported_by'        => $row['reported_by'] ?? null,
            'description'        => $row['description'] ?? null,
            'notify_reported_by' => $row['notify_reported_by'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.ticket_number'    => 'nullable|string|max:255',
            '*.parent_ticket'    => 'nullable|string|max:255',
            '*.ticket_type_id'   => 'nullable|integer',
            '*.ticket_status_id' => 'nullable|integer',
            '*.customer_name'    => 'nullable|string|max:255',
            '*.location_id'      => 'nullable|integer',
            '*.asset_id'         => 'nullable|integer',
            '*.department_id'    => 'nullable|integer',
            '*.assigned_to'      => 'nullable|integer',
            '*.ticket_group'     => 'nullable|string|max:255',
            '*.priority'         => 'nullable|string|max:100',
            '*.reported_date'    => 'nullable|date',
            '*.reported_by'      => 'nullable|string|max:255',
            '*.description'      => 'nullable|string',
            '*.notify_reported_by' => 'nullable',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.ticket_type_id.integer'   => 'Ticket Type ID must be a number.',
            '*.ticket_status_id.integer' => 'Ticket Status ID must be a number.',
            '*.location_id.integer'      => 'Location ID must be a number.',
            '*.asset_id.integer'         => 'Asset ID must be a number.',
            '*.department_id.integer'    => 'Department ID must be a number.',
            '*.assigned_to.integer'      => 'Assigned To must be a number.',
            '*.reported_date.date'       => 'Reported Date format is invalid.',
        ];
    }
}