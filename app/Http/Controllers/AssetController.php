<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\AssetAdditionalInfos;
use App\Models\AssetPurchaseInfos;
use App\Models\AssetFinacialInfos;
use App\Models\AssetAllotedInfos;
use App\Models\AssetWarrantyInfos;
use App\Models\AssetFiles;


class AssetController extends Controller
{

    public function store(Request $request)
    {

        try {

            //  1. MAIN ASSET
            $asset = Asset::create([
                'asset_name' => $request->asset_name,
                'asset_code' => $request->asset_code,
                'category_id' => $request->categ_id,
                'sub_category_id' => $request->sub_category_id,
                'location_id' => $request->location,
                'sub_location_id' => $request->sub_location_id,
                'status_id' => $request->status,
                'cwip_invoice_id' => $request->cwip_invoice_id,
            ]);

            //  2. IMAGE UPLOAD
            if ($request->hasFile('asset_image')) {
                $file = $request->file('asset_image');
                $path = $file->store('assets', 'public');

                $asset->update([
                    'asset_image' => $path
                ]);
            }

            //  3. ADDITIONAL INFO
            AssetAdditionalInfos::create([
                'asset_id' => $asset->id,
                'condition' => $request->condition,
                'brand' => $request->brand,
                'model' => $request->model,
                'description' => $request->description,
                'serial_no' => $request->serial_no,
            ]);

            //  4. PURCHASE INFO
            AssetPurchaseInfos::create([
                'asset_id' => $asset->id,
                'vendor_name' => $request->vendor_name,
                'invoice_date' => $request->invoice_date,
                'invoice_no' => $request->invoice_no,
                'purchase_date' => $request->purchase_date,
                'purchase_price' => $request->purchase_price,
                'is_self_owned' => $request->has('self_owned') ? 1 : 0,
            ]);

            //  5. FINANCIAL INFO
            AssetFinacialInfos::create([
                'asset_id' => $asset->id,
                'capitalization_price' => $request->capitalization_price,
                'capitalization_date' => $request->capitalization_date,
                'depreciation_percent' => $request->depreciation,
                'accumulated_depreciation' => $request->accumulated_dep,
                'scrap_value' => $request->scrap_value,
                'end_of_life' => $request->end_of_life,
            ]);

            //  6. ALLOTTED INFO
            AssetAllotedInfos::create([
                'asset_id' => $asset->id,
                'department' => $request->department,
                'transferred_to' => $request->transf_to,
                'allotted_upto' => $request->allotted_upto,
                'remarks' => $request->remark,
            ]);

            //  7. WARRANTY INFO
            AssetWarrantyInfos::create([
                'asset_id' => $asset->id,
                'amc_vendor' => $request->amc_vendor,
                'warranty_vendor' => $request->Warranty_vendor,
                'insurance_start_date' => $request->insurance_start_date,
                'insurance_end_date' => $request->insurance_end_date,
                'amc_start_date' => $request->amc_start_date,
                'amc_end_date' => $request->amc_end_date,
                'warranty_start_date' => $request->warranty_start_date,
                'warranty_end_date' => $request->warranty_end_date,
            ]);

            // 8. FILE UPLOAD
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $path = $file->store('asset_files', 'public');

                    AssetFiles::create([
                        'asset_id' => $asset->id,
                        'file_path' => $path
                    ]);
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Asset created successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
