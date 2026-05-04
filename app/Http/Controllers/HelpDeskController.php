<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Location;
use App\Models\TicketType;
use App\Models\TicketStatus;
use App\Models\Department;
use App\Models\Ticket;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TicketExport;

class HelpDeskController extends Controller
{
    public function insert()
    {
        $asset = Asset::select('id','asset_name','asset_code')->get();
        $location = Location::select('id','name')->get();
        $ticket_type = TicketType::select('id','ticket_type')->get();
        $ticket_status = TicketStatus::select('id','status')->get();
        $department = Department::select('id','name','code')->where('status',1)->get();
        return view('pages.help-desk.add',compact('asset','location','ticket_type','ticket_status','department'));
    }

    public function index()
    {
        $ticket_data = Ticket::with(['ticketType', 'location', 'asset'])->get();
        return view('pages.help-desk.list' , compact('ticket_data'));
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $asset = Asset::select('id','asset_name','asset_code')->get();
        $location = Location::select('id','name')->get();
        $ticket_type = TicketType::select('id','ticket_type')->get();
        $ticket_status = TicketStatus::select('id','status')->get();
        $department = Department::select('id','name','code')->where('status',1)->get();
        return view('pages.help-desk.edit', compact('ticket','asset','location','ticket_type','department','ticket_status'));
    }

     public function view($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('pages.help-desk.view', compact('ticket'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ticket_type_id' => 'required',
            'customer_name'  => 'required',
            'location_id'    => 'required',
        ]);

        Ticket::create([
            'ticket_number' => 'TKT-' . now()->format('Ymd') . rand(100, 999),
            'ticket_type_id'     => $request->ticket_type_id,
        'ticket_status_id'       => $request->status_id,
            'customer_name'      => $request->customer_name,
            'location_id'        => $request->location_id,
            'asset_id'           => $request->asset_id,
            'department_id'      => $request->department_id,
            'assigned_to'        => $request->assigned_to,
            'ticket_group'       => $request->ticket_group,
            'priority'           => $request->priority,
            'reported_date'      => $request->reported_date,
            'reported_by'        => $request->reported_by,
            'description'        => $request->description,
            'notify_reported_by' => $request->has('notify_reported_by') ? 1 : 0,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Ticket Created Successfully'
        ]);
    }

    public function destroy($id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return redirect()->back()->with('error', 'Record not found');
        }

        $ticket->delete();

        return response()->json([
                'status' => true,
                'message' => 'Ticket deleted successfully'
            ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ticket_type_id' => 'required',
            'customer_name'  => 'required',
            'location_id'    => 'required',
        ]);

        $ticket = Ticket::findOrFail($id);

        $ticket->update([
            // ❌ Do NOT regenerate ticket_number on update
            // 'ticket_number' => ...

            'ticket_type_id'     => $request->ticket_type_id,
            'ticket_status_id'     => $request->status_id,
            'customer_name'      => $request->customer_name,
            'location_id'        => $request->location_id,
            'asset_id'           => $request->asset_id,
            'department_id'      => $request->department_id,
            'assigned_to'        => $request->assigned_to,
            'ticket_group'       => $request->ticket_group,
            'priority'           => $request->priority,
            'reported_date'      => $request->reported_date,
            'reported_by'        => $request->reported_by,
            'description'        => $request->description,
            'notify_reported_by' => $request->has('notify_reported_by') ? 1 : 0,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Ticket Updated Successfully'
        ]);
    }

    public function exportTicket(Request $request)
    {
        $ticket = Ticket::with(['ticketType', 'location', 'asset'])->get();
        return Excel::download(new TicketExport($ticket), 'ticket.xlsx');
    }

    public function multipleRecordsFetch(Request $request)
    {
        $tickets = Ticket::whereIn('id', $request->ids)->get();
        $ticketTypes = TicketType::all();
        $locations = Location::all();
        $asset = Asset::select('id','asset_name')->get();

        return response()->json([
            'tickets' => $tickets,
            'ticket_types' => $ticketTypes,
            'locations' => $locations,
            'asset' => $asset,
        ]);
    }

    public function multipleRecordsUpdate(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:tickets,id',
        ]);

        try {

            $tickets = Ticket::whereIn('id', $request->ids)->get();

            foreach ($tickets as $ticket) {

                $id = $ticket->id;

                $ticket->update([
                    'ticket_type_id' => $request->ticket_type_id[$id] ?? $ticket->ticket_type_id,
                    'customer_name'  => $request->customer_name[$id] ?? $ticket->customer_name,
                    'location_id'    => $request->location_id[$id] ?? $ticket->location_id,
                    'asset_id'       => $request->asset_id[$id] ?? $ticket->asset_id,
                    'department_id'  => $request->department_id[$id] ?? $ticket->department_id,
                    'assigned_to'    => $request->assigned_to[$id] ?? $ticket->assigned_to,
                    'ticket_group'   => $request->ticket_group[$id] ?? $ticket->ticket_group,
                    'priority'       => $request->priority[$id] ?? $ticket->priority,
                    'reported_date'  => $request->reported_date[$id] ?? $ticket->reported_date,
                    'reported_by'    => $request->reported_by[$id] ?? $ticket->reported_by,
                    'description'    => $request->description[$id] ?? $ticket->description,

                    // checkbox fix
                    'notify_reported_by' => isset($request->notify_reported_by[$id]) ? 1 : 0,
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Records updated successfully!'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if (!empty($ids)) {
            Ticket::whereIn('id', $ids)->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Tickets deleted successfully'
        ]);
    }
}
