<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Condition;


class ConditionController extends Controller
{

    public function store(Request $request)
    {
        try {
            // dd($request->all());
             $request->validate([
                    'condition_name' => 'nullable|string',
                ]);

                Condition::create([
                    'condition_name' => $request->condition_name,
                ]);

            return response()->json([
                'status' => true,
                'message' => 'Condition Created Successfully'
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
        $conditions = Condition::all();
        return view('pages.administration.condition.index',compact('conditions'));
    }

    public function destroy($id)
    {
        $ticket = Condition::find($id);

        if (!$ticket) {
            return redirect()->back()->with('error', 'Record not found');
        }

        $ticket->delete();

        return response()->json([
                'status' => true,
                'message' => 'Condition deleted successfully'
            ]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'condition_name'  => 'required',
        ]);

        $condition = Condition::findOrFail($id);

        $condition->update([
            'condition_name' => $request->condition_name,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Condition Updated Successfully'
        ]);
    }
}
