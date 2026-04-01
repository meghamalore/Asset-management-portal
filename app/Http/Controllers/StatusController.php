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

        // 1. Create Status
        $status = Status::create([
            'status_type' => $request->status_type,
            'status_name' => $request->status_name,
            'next_status' => $request->next_status,
            'hold_pause_activity' => $request->has('hold_pause_activity') ? 1 : 0,
        ]);

        $categoryData = [];
        $subCategoryData = [];

        // 2. Process Categories & Subcategories
        if ($request->categ_id) {
            foreach ($request->categ_id as $item) {

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
        }

        // ❌ REMOVE THIS (causes undefined in AJAX)
        // dd($categoryData,$subCategoryData);

        // 3. Insert Category
        if (!empty($categoryData)) {
            StatusCategory::insert($categoryData);
        }

        // 4. Insert Subcategory
        if (!empty($subCategoryData)) {
            StatusSubCategory::insert($subCategoryData);
        }

        // 5. Localization Insert
        if ($request->localization_name) {
            foreach ($request->localization_name as $key => $name) {

                if (!empty($name)) {
                    StatusNameLocalization::create([
                        'status_id' => $status->id,
                        'status_name' => $name,
                        'language' => $request->localization_lang[$key] ?? 'en',
                    ]);
                }
            }
        }

        // ✅ IMPORTANT: Return JSON (for AJAX)
        return response()->json([
            'status' => true,
            'message' => 'Status with categories saved successfully!'
        ]);

    } catch (\Exception $e) {

        // 🔴 Error Handling
        return response()->json([
            'status' => false,
            'message' => $e->getMessage() // you can hide this in production
        ], 500);
    }
}
}
