<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\StatusNameLocalization;
use App\Models\StatusSubCategory;
use App\Models\StatusCategory;
use App\Models\Category;


class StatusController extends Controller
{
    public function store(Request $request)
    {
        try {

            // ✅ DEBUG (use once)
            // dd($request->all());

            // ✅ VALIDATION (IMPORTANT)
            // $request->validate([
            //     'status_type' => 'required',
            //     'status_name' => 'required',
            //     'next_status' => 'required',
            //     'categ_id' => 'required|array',     // ✅ FIX
            //     'categ_id.*' => 'required',
            //     'localization_name' => 'required|array',
            //     'localization_lang' => 'required|array',
            // ]);

            // 1. Create Status
            $status = Status::create([
                'status_type' => $request->status_type,
                'status_name' => $request->status_name,
                'next_status' => $request->next_status,
                'hold_pause_activity' => $request->has('hold_pause_activity') ? 1 : 0,
            ]);

            $categoryData = [];
            $subCategoryData = [];

            // ✅ ALWAYS use input() with default
            $categories = $request->input('categ_id', []);

            foreach ($categories as $item) {

                if (str_starts_with($item, 'cat_')) {
                    $categoryData[] = [
                        'status_id' => $status->id,
                        'category_id' => str_replace('cat_', '', $item),
                    ];
                }

                if (str_starts_with($item, 'sub_')) {
                    $subCategoryData[] = [
                        'status_id' => $status->id,
                        'sub_category_id' => str_replace('sub_', '', $item),
                    ];
                }
            }

            // 3. Insert Category Data
            if (!empty($categoryData)) {
                StatusCategory::insert($categoryData);
            }

            // 4. Insert Subcategory Data
            if (!empty($subCategoryData)) {
                StatusSubCategory::insert($subCategoryData);
            }

            // 5. Localization Insert
            $names = $request->input('localization_name', []);
            $langs = $request->input('localization_lang', []);

            foreach ($names as $key => $name) {
                if (!empty($name)) {
                    StatusNameLocalization::create([
                        'status_id' => $status->id,
                        'status_name' => $name,
                        'language' => $langs[$key] ?? 'en',
                    ]);
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Status with categories saved successfully!'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage() // 👈 show real error (for debug)
            ]);
        }
    }

    public function index()
    {

        $status = Status::with(['categories', 'subCategories'])->get();
        return view('pages.administration.status.index',compact('status'));

    }

    public function destroy($id)
    {
        $status = Status::find($id);

        if (!$status) {
            return redirect()->back()->with('error', 'Record not found');
        }

        $status->delete();

        return response()->json([
                'status' => true,
                'message' => 'Status deleted successfully'
            ]);
    }

    public function edit($id)
    {
        $status = Status::with(['categories', 'subCategories'])->find($id);
        $categories = Category::with('subCategories:id,category_id,name')->get();

        return view('pages.administration.status.edit', compact('status','categories'));
    }

    public function view($id)
    {
        $status = Status::with(['categories', 'subCategories'])->find($id);

        return view('pages.administration.status.view', compact('status'));
    }

    public function update(Request $request, $id)
    {
        $status = Status::findOrFail($id);

        // VALIDATION
        $request->validate([
            'status_type'          => 'required|string',
            'status_name'          => 'required|string|max:255',
            'next_status'          => 'nullable|string|max:255',
            'categories'           => 'nullable|array',
            'categories.*'         => 'exists:categories,id',
            'sub_categories'       => 'nullable|array',
            'sub_categories.*'     => 'exists:sub_categories,id',
            'hold_pause_activity'  => 'nullable|boolean',
        ]);

        // UPDATE STATUS
        $status->update([

            'status_type' => $request->status_type,

            'status_name' => $request->status_name,

            'next_status' => $request->next_status,

            'hold_pause_activity' => $request->has('hold_pause_activity') ? 1 : 0,

        ]);

        /*
        |--------------------------------------------------------------------------
        | SYNC CATEGORIES
        |--------------------------------------------------------------------------
        */

        if ($request->has('categories')) {

            $status->categories()->sync($request->categories);

        } else {

            $status->categories()->detach();

        }

        /*
        |--------------------------------------------------------------------------
        | SYNC SUB CATEGORIES
        |--------------------------------------------------------------------------
        */

        if ($request->has('sub_categories')) {

            $status->subCategories()->sync($request->sub_categories);

        } else {

            $status->subCategories()->detach();

        }

        return response()->json([

            'success' => true,

            'message' => 'Status updated successfully'

        ]);
    }


}
