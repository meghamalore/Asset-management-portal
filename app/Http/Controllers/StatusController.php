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
        // ✅ 1. Create Status
        $status = Status::create([
            'status_type' => $request->status_type,
            'status_name' => $request->status_name,
            'next_status' => $request->next_status,
            'hold_pause_activity' => $request->has('hold_pause_activity') ? 1 : 0,
        ]);

        // ✅ 2. Prepare arrays
        $categoryData = [];
        $subCategoryData = [];

        if ($request->categ_id) {
            foreach ($request->categ_id as $item) {

                // 👉 CATEGORY
                if (str_starts_with($item, 'cat_')) {
                    $categoryData[] = [
                        'status_id' => $status->id,
                        'category_id' => str_replace('cat_', '', $item),
                    ];
                }

                // 👉 SUBCATEGORY
                if (str_starts_with($item, 'sub_')) {
                    $subCategoryData[] = [
                        'status_id' => $status->id,
                        'sub_category_id' => str_replace('sub_', '', $item),
                    ];
                }
            }
        }

        // ✅ 3. Insert into status_category table
        if (!empty($categoryData)) {
            StatusCategory::insert($categoryData);
        }

        // ✅ 4. Insert into status_sub_category table
        if (!empty($subCategoryData)) {
            StatusSubCategory::insert($subCategoryData);
        }

        // ✅ Localization Insert
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

        return back()->with('success', 'Status with categories saved!');
    }
}
