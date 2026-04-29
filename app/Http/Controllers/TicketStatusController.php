<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketStatus;

class TicketStatusController extends Controller
{
    public function add()
    {
        return view('pages.help-desk-settings.ticket-status.add');
    }

    public function edit($id)
    {
        $ticket = TicketStatus::findOrFail($id);
        return view('pages.help-desk-settings.ticket-status.edit', compact('ticket'));
    }

    public function store(Request $request)
    {
        try {
             $request->validate([
                    'status_type_id'   => 'required',
                    'ticket_sub_status'   => 'required',
                    'auto_close_hours' => 'nullable|numeric',
                    'edit_based_on'    => 'nullable',
                ]);

                TicketStatus::create([
                    'status_type_id'   => $request->status_type_id,
                    'auto_close_hours' => $request->auto_close_hours,
                    'edit_based_on'    => $request->edit_based_on,
                    'sub_status'       => $request->ticket_sub_status,
                    'is_default'       => $request->is_default ? 1 : 0,
                    'auto_checkout'    => $request->auto_checkout ? 1 : 0,
                    'tat_count'        => $request->tat_count ? 1 : 0,
                ]);

            return response()->json([
                'status' => true,
                'message' => 'Ticket Status Created Successfully'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        $tickets = TicketStatus::all();
        return view('pages.help-desk-settings.ticket-status.index', compact('tickets'));
    }

    public function destroy($id)
    {
        $ticket = TicketStatus::find($id);

        if (!$ticket) {
            return redirect()->back()->with('error', 'Record not found');
        }

        $ticket->delete();

        return response()->json([
                'status' => true,
                'message' => 'Ticket status deleted successfully'
            ]);
    }

    public function update(Request $request, $id)
    {
        $ticket = TicketStatus::findOrFail($id);

        //  Validation
        $request->validate([
            'auto_close_hours' => 'nullable|numeric',
            'sub_status'       => 'nullable|string|max:255',
            'is_default'       => 'nullable|boolean',
            'edit_based_on'    => 'nullable|string|max:255',
            'auto_checkout'    => 'nullable|boolean',
            'tat_count'        => 'nullable|numeric',
        ]);

        //  Update data
        $ticket->update([
            'auto_close_hours' => $request->auto_close_hours,
            'sub_status'       => $request->sub_status,
            'is_default'       => $request->is_default ?? 0,
            'edit_based_on'    => $request->edit_based_on,
            'auto_checkout'    => $request->auto_checkout ?? 0,
            'tat_count'        => $request->tat_count,
        ]);

        return response()->json([
                'status' => true,
                'message' => 'Ticket Status Updated Successfully'
            ]);
    }
     
}
