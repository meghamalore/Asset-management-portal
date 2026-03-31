<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryLocalization;
use App\Models\CategoryFinacialInformation;
use App\Models\SubCategory;
use App\Models\AssetCategoryActivitySchedule;
use DB;

class CategoryController extends Controller
{
    public function insert(){
        return view('pages.asset-management.add');
    }

    public function store(Request $request)
    {
        try {
            
            //  1. CATEGORY
            $category = Category::create([
                'name' => $request->local_category_name,
                'is_inventory' => $request->is_inventory ? 1 : 0,
                'is_asset_link' => $request->is_link_asset ? 1 : 0,
                'category_code' => $request->category_code,
                'trafs_duration' => $request->trafs_duration,
                'trafs_duration_type' => $request->trafs_duration_type,
                'cascade' => $request->cascade ? 1 : 0,
                'auto_extended' => $request->allow_auto ? 1 : 0,
                ]);
                // 2. SUB CATEGORY (optional)
            if ($request->parent_category_name) {
                SubCategory::create([
                    'category_id' => $category->id,
                    'name' => $request->parent_category_name
                ]);
            }

            // 3. FINANCIAL INFO
            CategoryFinacialInformation::create([
                'category_id' => $category->id,
                'end_of_life' => $request->end_of_life,
                'end_of_life_type' => $request->end_of_life_type,
                'scrap_value' => $request->scrap_value,
                'scrap_value_type' => $request->scrap_value_type,
                'depreciation' => $request->depreciation,
                'income_tax_depreciation' => $request->income_tax_depreciation,
            ]);

            // 4. ACTIVITY SCHEDULE (MULTIPLE)
            if ($request->activity_type) {
                foreach ($request->activity_type as $key => $value) {

                    AssetCategoryActivitySchedule::create([
                        'category_id' => $category->id,
                        'assigned_based_on' => $request->assign_based[$key] ?? null,
                        'user_type' => $request->user_type[$key] ?? null,
                        'assign_role' => $request->assign_role[$key] ?? null,
                        'assignee' => $request->assignee[$key] ?? null,
                        'activity_type' => $value,
                        'occurs' => $request->occurs[$key] ?? null,
                        'start_schedule_after_days' => $request->start_schedule_after[$key] ?? null,
                        'activity_reminders' => $request->activity_remider[$key] ?? null,
                        'schedule_based_on' => $request->schedule_based_on[$key] ?? null,
                        'custom_days' => $request->custom_days[$key] ?? null,
                    ]);
                }
            }

            //  5. LOCALIZATION (MULTIPLE)
            if ($request->language) {
                foreach ($request->language as $key => $lang) {

                    CategoryLocalization::create([
                        'category_id' => $category->id,
                        'category_name' => $request->category_name[$key] ?? null,
                        'language' => $lang
                    ]);
                }
            }


            return response()->json([
                'status' => true,
                'message' => 'Category Created Successfully'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
