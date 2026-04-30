<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketType;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Support\Facades\Validator;


class TicketTypeController extends Controller
{
    public function add()
    {
        $category = Category::all();
        $location = Location::all();
        return view('pages.help-desk-settings.ticket-type.add',compact('category','location'));
    }

    public function index()
    {
        $ticket_type =  TicketType::with('category','location')->get();
        return view('pages.help-desk-settings.ticket-type.index',compact('ticket_type'));
    }

    public function store(Request $request)
    {
        try {
                $validator = Validator::make($request->all(), [
                    'ticket_type'     => 'required|string|max:255',
                    'category_id'     => 'required|exists:categories,id',
                    'expected_tat'    => 'required|integer',
                    'activity_type'   => 'required|in:calibration,inspection,warranty_expiry',
                    'duration_type'   => 'required|in:day,hours,minutes',
                    'reason'          => 'required|string',
                    'location_id'     => 'required|exists:locations,id',
                    'role_type'       => 'required|in:user_involved,user_role',
                    'reopen_allowed'  => 'required'
                ], [
                    //  Custom Messages
                    'ticket_type.required' => 'Ticket Type is required',
                    'category_id.required' => 'Category is required',
                    'category_id.exists'   => 'Invalid category selected',
                    'expected_tat.required'=> 'Expected TAT is required',
                    'expected_tat.integer' => 'Expected TAT must be a number',
                    'activity_type.required'=> 'Activity Type is required',
                    'duration_type.required'=> 'Duration Type is required',
                    'reason.required'      => 'Reason is required',
                    'location_id.required' => 'Location is required',
                    'role_type.required'   => 'Role is required',
                    'reopen_allowed.required' => 'Re-open duration is required'
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'errors' => $validator->errors()
                    ], 422);
                }

                TicketType::create([
                    'ticket_type'        => $request->ticket_type,
                    'category_id'        => $request->category_id,
                    'expected_tat'       => $request->expected_tat,
                    'activity_type'      => $request->activity_type,
                    'duration_type'      => $request->duration_type,
                    'reason'             => $request->reason,
                    'location_id'        => $request->location_id,
                    'role_type'          => $request->role_type,
                    'reopen_allowed'     => $request->reopen_allowed,

                    //  Checkbox Handling (important)
                    'otp_required'       => $request->has('otp_required'),
                    'generate_email'     => $request->has('generate_email'),
                    'change_asset_status'=> $request->has('change_asset_status'),
                ]);

            return response()->json([
                'status' => true,
                'message' => 'Ticket Type Created Successfully'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $ticket = TicketType::find($id);

        if (!$ticket) {
            return redirect()->back()->with('error', 'Record not found');
        }

        $ticket->delete();

        return response()->json([
                'status' => true,
                'message' => 'Ticket Type deleted successfully'
            ]);
    }

    public function edit($id)
    {
        $ticket = TicketType::findOrFail($id);
        return view('pages.help-desk-settings.ticket-status.edit', compact('ticket'));
    }
}
