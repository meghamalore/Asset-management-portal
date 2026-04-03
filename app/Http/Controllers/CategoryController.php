<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Location;
use App\Models\Status;
use App\Models\CategoryLocalization;
use App\Models\CategoryFinacialInformation;
use App\Models\SubCategory;
use App\Models\Asset;
use App\Models\AssetCategoryActivitySchedule;
use DB;

class CategoryController extends Controller
{
    // public function insert(){

    //     $categories = Category::select('id','name')->get();
    //     $ids = $categories->pluck('id');
    //     $subCategories = SubCategory::where('category_id', $ids)->get();

    //     $locations = Location::select('id','name')->get();
    //     return view('pages.asset-management.add',compact('categories','locations'));

    // }


    public function insert()
    {
        $only_categories = Category::select('id','name')->get();

        $categories = Category::with('subCategories:id,category_id,name')->get();

        $locations = Location::select('id','name')->get();
        $status = Status::select('id','status_name')->get();
        $asset_list = Asset::select('id','asset_name','asset_code')->get();

        return view('pages.asset-management.add', compact('categories','locations','only_categories','status','asset_list'));
    }

    public function store(Request $request)
    {
        try {

            // VALIDATION (extra safety)
            if (!$request->parent_category_name && !$request->selective_category_id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Please enter category name or select one'
                ], 422);
            }

            // 1. CATEGORY (create OR use existing)
            if ($request->parent_category_name) {

                $category = Category::create([
                    'name' => $request->parent_category_name,
                    'is_inventory' => $request->is_inventory ? 1 : 0,
                    'is_asset_link' => $request->is_link_asset ? 1 : 0,
                    'category_code' => $request->category_code,
                    'trafs_duration' => $request->trafs_duration,
                    'trafs_duration_type' => $request->trafs_duration_type,
                    'cascade' => $request->cascade ? 1 : 0,
                    'auto_extended' => $request->allow_auto ? 1 : 0,
                ]);

                $category_id = $category->id;

            } else {
                // use selected category
                $category_id = $request->selective_category_id;
            }

            // 2. SUB CATEGORY (only once)
            SubCategory::create([
                'category_id' => $category_id,
                'name' => $request->sub_category_name
            ]);

            //  3. FINANCIAL INFO
            CategoryFinacialInformation::create([
                'category_id' => $category_id,
                'end_of_life' => $request->end_of_life,
                'end_of_life_type' => $request->end_of_life_type,
                'scrap_value' => $request->scrap_value,
                'scrap_value_type' => $request->scrap_value_type,
                'depreciation' => $request->depreciation,
                'income_tax_depreciation' => $request->income_tax_depreciation,
            ]);

            //  4. ACTIVITY SCHEDULE (MULTIPLE)
            if ($request->activity_type) {
                foreach ($request->activity_type as $key => $value) {

                    AssetCategoryActivitySchedule::create([
                        'category_id' => $category_id,
                        'assigned_based_on' => $request->assign_based[$key] ?? null,
                        'user_type' => $request->user_type[$key] ?? null,
                        'assign_role' => $request->assign_role[$key] ?? null,
                        'assignee' => $request->assignee[$key] ?? null,
                        'activity_type' => $value,
                        'occurs' => $request->occurs[$key] ?? null,
                        'start_schedule_after_days' => $request->start_schedule_after[$key] ?? null,
                        'activity_reminders' => $request->activity_reminder[$key] ?? null, // ✅ fixed typo
                        'schedule_based_on' => $request->schedule_based_on[$key] ?? null,
                        'custom_days' => $request->custom_days[$key] ?? null,
                    ]);
                }
            }

            // 5. LOCALIZATION (MULTIPLE)
            if ($request->language) {
                foreach ($request->language as $key => $lang) {

                    CategoryLocalization::create([
                        'category_id' => $category_id,
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

    public function getSubCategories($id)
    {
        $subCategories = SubCategory::where('category_id', $id)->get();

        return response()->json($subCategories);
    }
}
