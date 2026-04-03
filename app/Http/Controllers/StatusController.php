<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\StatusNameLocalization;
use App\Models\StatusSubCategory;
use App\Models\StatusCategory;


class StatusController extends Controller
{
    public function store(Request $request)
    {
        try {

            // ✅ DEBUG (use once)
            // dd($request->all());

            // ✅ VALIDATION (IMPORTANT)
            $request->validate([
                'status_type' => 'required',
                'status_name' => 'required',
                'next_status' => 'required',
                'categ_id' => 'required|array',     // ✅ FIX
                'categ_id.*' => 'required',
                'localization_name' => 'required|array',
                'localization_lang' => 'required|array',
            ]);

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


}
