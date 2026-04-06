<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomeView;

class CustomeViewControlller extends Controller
{


    public function destroy($id)
    {
        try {
            $view = CustomeView::findOrFail($id);
            $view->delete();

            return response()->json([
                'status' => true,
                'message' => 'View deleted successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {

            CustomeView::create([
                'view_name'  => $request->view_name,
                'columns'    => $request->columns, // [1,2,3]
                'is_default' => $request->has('is_default'),
                'is_private' => $request->has('is_private'),
                'role_id'    => $request->role_id,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'View Created Successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $view = CustomeView::findOrFail($id);

        return response()->json([
            'columns' => $view->columns // [1,2,3]
        ]);
    }
}
