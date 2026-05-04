<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\AssetAdditionalInfos;
use App\Models\AssetPurchaseInfos;
use App\Models\AssetFinacialInfos;
use App\Models\AssetAllotedInfos;
use App\Models\AssetWarrantyInfos;
use App\Models\AssetLinks;
use App\Models\AssetFiles;
use App\Models\ColumnMaster;
use App\Models\CustomeView;
use App\Models\Location;
use App\Models\SubLocation;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ScheduleActivity;
use App\Models\ScheduleActivityAssetsLink;
use App\Models\Status;
use App\Models\AssetTransfer;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AssetsExport;
use Illuminate\Support\Facades\Storage;


class AssetController extends Controller
{

    public function store(Request $request)
    {
        //  VALIDATION
        $request->validate([
            'asset_name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9\s]+$/'], // BUG_001 - Asset Name special characters validation
            'categ_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'location' => 'required|exists:locations,id',
            'sub_location_id' => 'nullable|exists:sub_locations,id',
            'status' => 'required|exists:statuses,id',

            // Additional Info
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'serial_no' => 'nullable|string|max:255',

            // Purchase Info
            'vendor_name' => 'nullable|string|max:255',
            'invoice_date' => 'nullable|date',
            'purchase_date' => 'nullable|date',
            'purchase_price' => 'nullable|numeric|min:0',
            'po_number' => 'nullable|numeric|min:0',

            // Financial Info
            'capitalization_price' => 'nullable|numeric|min:0',
            'depreciation' => 'nullable|numeric|min:0|max:100',
            'scrap_value' => 'nullable|numeric|min:0',

            // File & Image
            'asset_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'files.*' => 'nullable|file|max:5120',

            // Linking
            'link_asset' => 'nullable|array',
            'link_asset.*' => 'exists:assets,id',

            // BUG_003 - CWIP Invoice ID special characters validation
            'cwip_invoice_id' => ['nullable', 'string', 'max:255', 'regex:/^[A-Za-z0-9\s\-]+$/'],
        ]);

        try {
            if (empty($request->asset_code)) {

            $year = date('Y');
            $random = rand(100000, 999999);
            $assetCode = 'AST' . $year . $random;

            while (\App\Models\Asset::where('asset_code', $assetCode)->exists()) {
                $random = rand(100000, 999999);
                $assetCode = 'AST' . $year . $random;
            }
            } else {
                $assetCode = $request->asset_code;
            }
            //  1. MAIN ASSET
            $asset = Asset::create([
                'asset_name' => $request->asset_name,
                'asset_code' => $assetCode,
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

            if ($request->link_asset) {
                foreach ($request->link_asset as $linkedId) {

                    // prevent self-link (optional)
                    if ($linkedId != $asset->id) {

                        AssetLinks::create([
                            'asset_id' => $asset->id,
                            'linked_asset_id' => $linkedId,
                        ]);
                    }
                }
            }

            //  4. PURCHASE INFO
            AssetPurchaseInfos::create([
                'asset_id' => $asset->id,
                'vendor_name' => $request->vendor_name,
                'invoice_date' => $request->invoice_date,
                'invoice_no' => $request->invoice_no,
                'asset_po_number' => $request->po_number,
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

    public function index()
    {
        $categories = Category::with('subCategories:id,category_id,name')->get();
        $asset_data = Asset::with('category','location','status','additionalInfo','purchaseInfo','finacialInfos','assetallotedInfos','assetwarrantyInfos')->latest()->whereNull('status')->get();
        $column_master = ColumnMaster::select('id','column_name')->get();
        $views = CustomeView::select('id','view_name')->get();
        $location = Location::select('id','name')->get();
        $sub_location = SubLocation::select('id','name','location_id')->get();
        $status = Status::select('id','status_name')->get();
        $asset_list = Asset::select('id','asset_name','asset_code')->get();

        return view('pages.asset-management.list',compact('asset_data','column_master','views','location','sub_location','categories','status','asset_list'));
    }

    public function getAssetDetails($id)
    {
        $asset = Asset::with([
            'additionalInfo',
            'purchaseInfo',
            'finacialInfos',
            'assetallotedInfos',
            'assetwarrantyInfos',
            'linkedAssets',
            'files'
        ])->findOrFail($id);
        return response()->json([
            'asset' => $asset,
            'additional' => $asset->additionalInfo,
            'purchase' => $asset->purchaseInfo,
            'financial' => $asset->finacialInfos,
            'assetallotedInfos' => $asset->assetallotedInfos,
            'assetwarrantyInfos' => $asset->assetwarrantyInfos,
            'linked_assets' => $asset->linkedAssets,
            'files' => $asset->files
        ]);
    }

    public function viewAssetDetails($id)
    {
         $asset = Asset::with([
            'additionalInfo',
            'purchaseInfo',
            'finacialInfos',
            'assetallotedInfos',
            'assetwarrantyInfos',
            'linkedAssets',
            'files',
            'category.subCategories',
            'subCategory',
            'location.subLocation',
            'SubLocation',
            'status'
        ])->findOrFail($id);

        return view('pages.asset-management.view',compact('asset'));

    }

    public function updateAsset(Request $request, $id)
    {

        try {

            $asset = Asset::where('id', $id)->first();

            $asset->update([
                'asset_name' => $request->asset_name,
                'asset_code' => $request->asset_code,
                'category_id' => $request->categ_id,
                'sub_category_id' => $request->sub_category_id,
                'location_id' => $request->location,
                'status' => $request->status,
                'sub_location_id' => $request->sub_location_id,
                'cwip_invoice_id' => $request->cwip_invoice_id,
            ]);


             // Handle image upload
            if ($request->hasFile('asset_image')) {

                // Delete old image
                if ($asset->asset_image && Storage::disk('public')->exists($asset->asset_image)) {
                    Storage::disk('public')->delete($asset->asset_image);
                }

                // Store new image
                $path = $request->file('asset_image')->store('assets', 'public');
                // Save new path
                $asset->asset_image = $path;
            }

            $assetadditional = AssetAdditionalInfos::where('asset_id', $id)->first();

            if ($assetadditional) {
                $assetadditional->update([
                    'condition' => $request->condition,
                    'brand' => $request->brand,
                    'model' => $request->model,
                    'description' => $request->description,
                    'serial_no' => $request->serial_no,
                ]);
            }

            AssetLinks::where('asset_id', $id)->delete();

            if ($request->has('link_asset') && is_array($request->link_asset)) {
                foreach ($request->link_asset as $linkedId) {
                    $data[] = [
                        'asset_id' => $id,
                        'linked_asset_id' => $linkedId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                AssetLinks::insert($data);
            }

            $assetadditional = AssetAdditionalInfos::where('asset_id', $id)->first();

            if ($assetadditional) {
                $assetadditional->update([
                    'condition' => $request->condition,
                    'brand' => $request->brand,
                    'model' => $request->model,
                    'description' => $request->description,
                    'serial_no' => $request->serial_no,
                ]);
            }

            $assetpurchase = AssetPurchaseInfos::where('asset_id', $id)->first();

            if ($assetpurchase) {
                $assetpurchase->update([
                    'vendor_name'     => $request->vendor_name,
                    'po_number'       => $request->po_number,
                    'invoice_date'    => $request->invoice_date,
                    'invoice_no'      => $request->invoice_no,
                    'purchase_date'   => $request->purchase_date,
                    'purchase_price'  => $request->purchase_price,
                    'is_self_owned'   => $request->is_self_owned ?? 0,
                ]);
            }

            $assetfinacial = AssetFinacialInfos::where('asset_id', $id)->first();

            if ($assetfinacial) {
                $assetfinacial->update([
                    'capitalization_price' => $request->capitalization_price,
                    'capitalization_date' => $request->capitalization_date,
                    'depreciation_percent' => $request->depreciation,
                    'accumulated_depreciation' => $request->accumulated_dep,
                    'scrap_value' => $request->scrap_value,
                    'end_of_life' => $request->end_of_life,
                ]);
            }

            $assetalloted = AssetAllotedInfos::where('asset_id', $id)->first();

            if ($assetalloted) {
                $assetalloted->update([
                    'department' => $request->department,
                    'transferred_to' => $request->transf_to,
                    'allotted_upto' => $request->allotted_upto,
                    'remarks' => $request->remark,
                ]);
            }

            $assetwarranty = AssetWarrantyInfos::where('asset_id', $id)->first();

            if ($assetwarranty) {
                $assetwarranty->update([
                'amc_vendor' => $request->amc_vendor,
                'warranty_vendor' => $request->Warranty_vendor,
                'insurance_start_date' => $request->insurance_start_date,
                'insurance_end_date' => $request->insurance_end_date,
                'amc_start_date' => $request->amc_start_date,
                'amc_end_date' => $request->amc_end_date,
                'warranty_start_date' => $request->warranty_start_date,
                'warranty_end_date' => $request->warranty_end_date,
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Asset updated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function transfer(Request $request)
    {
        try {
            $transferredAssets = [];
            if (!isset($request->assets) || empty($request->assets)) {
                return response()->json([
                    'status' => false,
                    'message' => 'No assets selected for transfer'
                ], 400);
            }
            foreach ($request->assets as $assetData) {
                $asset = Asset::find($assetData['asset_id']);
                if ($asset) {
                    // Store old values for transfer record
                    $oldLocationId = $asset->location_id;
                    $oldSubLocationId = $asset->sub_location_id;
                    $oldStatusId = $asset->status_id;
                    // Get old allotted info
                    $oldAllottedInfo = AssetAllotedInfos::where('asset_id', $asset->id)->first();
                    $oldTransferredTo = $oldAllottedInfo->transferred_to ?? null;
                    $oldRemarks = $oldAllottedInfo->remarks ?? null;
                    $oldAllottedUpto = $oldAllottedInfo->allotted_upto ?? null;
                    // Update location
                    if (isset($assetData['location_id']) && !empty($assetData['location_id'])) {
                        $asset->location_id = $assetData['location_id'];
                    }
                    // Update sub location
                    if (isset($assetData['sub_location_id']) && !empty($assetData['sub_location_id'])) {
                        $asset->sub_location_id = $assetData['sub_location_id'];
                    }
                    // Update status
                    if (isset($assetData['transfer_status']) && !empty($assetData['transfer_status'])) {
                        $asset->status_id = $assetData['transfer_status'];
                    }
                    $asset->save();
                    // Update allotted info
                    $allottedInfo = AssetAllotedInfos::where('asset_id', $asset->id)->first();
                    $newTransferredTo = null;
                    $newRemarks = null;
                    $newAllottedUpto = null;
                    if ($allottedInfo) {
                        if (isset($assetData['transferred_to']) && !empty($assetData['transferred_to'])) {
                            $allottedInfo->transferred_to = $assetData['transferred_to'];
                            $newTransferredTo = $assetData['transferred_to'];
                        }
                        if (isset($assetData['remarks']) && !empty($assetData['remarks'])) {
                            $allottedInfo->remarks = $assetData['remarks'];
                            $newRemarks = $assetData['remarks'];
                        }
                        if (isset($assetData['allotted_upto']) && !empty($assetData['allotted_upto'])) {
                            $allottedInfo->allotted_upto = $assetData['allotted_upto'];
                            $newAllottedUpto = $assetData['allotted_upto'];
                        }
                        $allottedInfo->save();
                    } else {
                        // Create if not exists
                        $newTransferredTo = $assetData['transferred_to'] ?? null;
                        $newRemarks = $assetData['remarks'] ?? null;
                        $newAllottedUpto = $assetData['allotted_upto'] ?? null;
                        AssetAllotedInfos::create([
                            'asset_id' => $asset->id,
                            'transferred_to' => $newTransferredTo,
                            'remarks' => $newRemarks,
                            'allotted_upto' => $newAllottedUpto,
                        ]);
                    }
                    // Handle file uploads
                    $filePaths = [];
                    if ($request->hasFile('files')) {
                        foreach ($request->file('files') as $file) {
                            $path = $file->store('asset_transfers', 'public');
                            $filePaths[] = $path;
                        }
                    }
                    // Create transfer record
                    AssetTransfer::create([
                        'asset_id' => $asset->id,
                        'from_location_id' => $oldLocationId,
                        'to_location_id' => $assetData['location_id'] ?? null,
                        'from_sub_location_id' => $oldSubLocationId,
                        'to_sub_location_id' => $assetData['sub_location_id'] ?? null,
                        'transfer_status' => $assetData['transfer_status'] ?? null,
                        'transferred_to' => $newTransferredTo,
                        'allotted_upto' => $newAllottedUpto,
                        'transfer_cc' => $request->transfer_cc ?? null,
                        'remarks' => $newRemarks,
                        'file_paths' => json_encode($filePaths),
                        'transferred_by' => auth()->id(),
                        'transferred_at' => now(),
                    ]);
                    $transferredAssets[] = $asset->asset_name;
                }
            }
            return response()->json([
                'status' => true,
                'message' => count($transferredAssets) . ' asset(s) transferred successfully!',
                'assets' => $transferredAssets
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function storeScheduleActivity(Request $request)
    {
        try {
            // Create main schedule activity
            $schedule = ScheduleActivity::create([
                'location'            => $request->location,
                'activity_type'       => $request->activity_type,
                'description'         => $request->description,
                'category'            => $request->categoty,
                'user_group'          => $request->user_group,
                'assigned_to'         => $request->assigned_to,
                'occurs'              => $request->occurs,
                'start_date'          => $request->start_date,
                'end_date'            => $request->end_date,
                'activity_reminder'  => $request->activity_reminder,
                'email_based_on'      => $request->email_based_on,
                'grace_before'        => $request->grace_before,
                'grace_after'         => $request->grace_after,
                'cc'                  => $request->cc,
                'vendor_name'          => $request->vendor_name,
                'amount'               => $request->amount,
            ]);

            // Store linked assets (multiple select)
            if ($request->has('link_asset')) {
                foreach ($request->link_asset as $assetId) {
                    ScheduleActivityAssetsLink::create([
                        'schedule_activity_id' => $schedule->id,
                        'asset_id'             => $assetId,
                    ]);
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Schedule activity created successfully'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function exportAssets(Request $request)
    {
            $assets = Asset::with([
            'category',
            'location',
            'status',
            'additionalInfo',
            'purchaseInfo',
            'finacialInfos',
            'assetallotedInfos',
            'assetwarrantyInfos'
            ])->get();
        return Excel::download(new AssetsExport($assets), 'assets.xlsx');
    }

    /**
     * Bulk Fetch API - Get asset data for bulk update
     */
    public function bulkFetch(Request $request)
    {
        try {
            $assetIds = $request->input('asset_ids', []);

            if (empty($assetIds)) {
                return response()->json([
                    'status' => false,
                    'message' => 'No asset IDs provided'
                ], 400);
            }

            $assets = Asset::with([
                'category',
                'subCategory',
                'location',
                'subLocation',
                'status',
                'additionalInfo',
                'purchaseInfo',
                'finacialInfos',
                'assetallotedInfos',
                'assetwarrantyInfos'
            ])
            ->whereIn('asset_code', $assetIds)
            ->orWhereIn('id', $assetIds)
            ->orderBy('id', 'asc')
            ->get();

            if ($assets->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'No assets found'
                ], 404);
            }

            // Format data for bulk update grid
            $formattedAssets = $assets->map(function($asset) {
                return [
                    'id' => $asset->id,
                    'asset_name' => $asset->asset_name ?? '',
                    'asset_code' => $asset->asset_code ?? '',
                    'asset_image' => $asset->asset_image ?? '',
                    'category_id' => $asset->category_id ?? '',
                    'category' => $asset->category->name ?? '',
                    'sub_category' => $asset->subCategory->name ?? '',
                    'location_id' => $asset->location_id ?? '',
                    'location' => $asset->location->name ?? '',
                    'sub_location' => $asset->additionalInfo->sub_location ?? $asset->subLocation->name ?? '',
                    'status_id' => $asset->status_id ?? '',
                    'status' => $asset->status->status_name ?? '',
                    'cwip_invoice_id' => $asset->cwip_invoice_id ?? '',

                    // Additional Info
                    'condition' => $asset->additionalInfo->condition ?? '',
                    'brand' => $asset->additionalInfo->brand ?? '',
                    'model' => $asset->additionalInfo->model ?? '',
                    'description' => $asset->additionalInfo->description ?? '',
                    'serial_no' => $asset->additionalInfo->serial_no ?? '',

                    // Purchase Info
                    'vendor_name' => $asset->purchaseInfo->vendor_name ?? '',
                    'asset_po_number' => $asset->purchaseInfo->asset_po_number ?? '',
                    'invoice_date' => $asset->purchaseInfo->invoice_date ?? '',
                    'invoice_no' => $asset->purchaseInfo->invoice_no ?? '',
                    'purchase_date' => $asset->purchaseInfo->purchase_date ?? '',
                    'purchase_price' => $asset->purchaseInfo->purchase_price ?? '',
                    'is_self_owned' => $asset->purchaseInfo->is_self_owned ?? 0,

                    // Financial Info
                    'capitalization_price' => $asset->finacialInfos->capitalization_price ?? '',
                    'end_of_life' => $asset->finacialInfos->end_of_life ?? '',
                    'capitalization_date' => $asset->finacialInfos->capitalization_date ?? '',
                    'depreciation_percent' => $asset->finacialInfos->depreciation_percent ?? '',
                    'accumulated_depreciation' => $asset->finacialInfos->accumulated_depreciation ?? '',
                    'scrap_value' => $asset->finacialInfos->scrap_value ?? '',
                    'income_tax_depreciation_percent' => $asset->finacialInfos->income_tax_depreciation_percent ?? '',

                    // Allotted Info
                    'department' => $asset->assetallotedInfos->department ?? '',
                    'transferred_to' => $asset->assetallotedInfos->transferred_to ?? '',
                    'allotted_upto' => $asset->assetallotedInfos->allotted_upto ?? '',
                    'remarks' => $asset->assetallotedInfos->remarks ?? '',

                    // Warranty Info
                    'amc_vendor' => $asset->assetwarrantyInfos->amc_vendor ?? '',
                    'warranty_vendor' => $asset->assetwarrantyInfos->warranty_vendor ?? '',
                    'insurance_start_date' => $asset->assetwarrantyInfos->insurance_start_date ?? '',
                    'insurance_end_date' => $asset->assetwarrantyInfos->insurance_end_date ?? '',
                    'amc_start_date' => $asset->assetwarrantyInfos->amc_start_date ?? '',
                    'amc_end_date' => $asset->assetwarrantyInfos->amc_end_date ?? '',
                    'warranty_start_date' => $asset->assetwarrantyInfos->warranty_start_date ?? '',
                    'warranty_end_date' => $asset->assetwarrantyInfos->warranty_end_date ?? '',
                ];
            });

            return response()->json([
                'status' => true,
                'assets' => $formattedAssets,
                'count' => $formattedAssets->count()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch assets: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk Update API - Update multiple assets
     */
    public function bulkUpdate(Request $request)
    {
        try {
            $changes = $request->input('changes', []);

            if (empty($changes)) {
                return response()->json([
                    'status' => false,
                    'message' => 'No changes provided'
                ], 400);
            }

            $updatedAssets = [];
            $errors = [];

            foreach ($changes as $change) {
                $assetId = $change['asset_id'];
                $fieldChanges = $change['changes'] ?? [];

                if (empty($fieldChanges)) {
                    continue;
                }

                $asset = Asset::find($assetId);
                if (!$asset) {
                    $errors[] = "Asset ID {$assetId} not found";
                    continue;
                }

                $hasAnyChanges = false;

                foreach ($fieldChanges as $field => $data) {
                    $newValue = $data['new'] ?? null;

                    if ($field === 'asset_name' && empty($newValue)) {
                        $errors[] = "Asset name is required for asset ID {$assetId}";
                        continue 2;
                    }

                    switch ($field) {
                        case 'asset_name':
                        case 'asset_image':
                        case 'category_id':
                        case 'sub_category_id':
                        case 'location_id':
                        case 'sub_location_id':
                        case 'status_id':
                        case 'cwip_invoice_id':
                            $asset->{$field} = $newValue;
                            $hasAnyChanges = true;
                            break;

                        case 'status':
                            $status = Status::where('status_name', $newValue)->first();
                            if ($status) {
                                $asset->status_id = $status->id;
                                $hasAnyChanges = true;
                            }
                            break;

                        case 'category':
                            $category = Category::where('name', $newValue)->first();
                            if ($category) {
                                $asset->category_id = $category->id;
                                $hasAnyChanges = true;
                            }
                            break;

                        case 'sub_category':
                            $subCategory = SubCategory::where('name', $newValue)->first();
                            if ($subCategory) {
                                $asset->sub_category_id = $subCategory->id;
                                $hasAnyChanges = true;
                            }
                            break;

                        case 'location':
                            $location = Location::where('name', $newValue)->first();
                            if ($location) {
                                $asset->location_id = $location->id;
                                $hasAnyChanges = true;
                            }
                            break;

                        case 'condition':
                        case 'brand':
                        case 'model':
                        case 'description':
                        case 'serial_no':
                            $additionalInfo = $asset->additionalInfo ?? $asset->additionalInfo()->firstOrNew([]);
                            $additionalInfo->{$field} = $newValue;
                            $additionalInfo->save();
                            $hasAnyChanges = true;
                            break;

                        case 'sub_location':
                            $subLocation = SubLocation::where('name', $newValue)->first();
                            if ($subLocation) {
                                $asset->sub_location_id = $subLocation->id;
                                $hasAnyChanges = true;
                            }
                            break;

                        case 'vendor_name':
                        case 'asset_po_number':
                        case 'invoice_date':
                        case 'invoice_no':
                        case 'purchase_date':
                        case 'purchase_price':
                        case 'is_self_owned':
                            $purchaseInfo = $asset->purchaseInfo ?? $asset->purchaseInfo()->firstOrNew([]);
                            $purchaseInfo->{$field} = $newValue;
                            $purchaseInfo->save();
                            $hasAnyChanges = true;
                            break;

                        case 'capitalization_price':
                        case 'end_of_life':
                        case 'capitalization_date':
                        case 'depreciation_percent':
                        case 'accumulated_depreciation':
                        case 'scrap_value':
                        case 'income_tax_depreciation_percent':
                            $financialInfo = $asset->finacialInfos ?? $asset->finacialInfos()->firstOrNew([]);
                            $financialInfo->{$field} = $newValue;
                            $financialInfo->save();
                            $hasAnyChanges = true;
                            break;

                        case 'department':
                        case 'transferred_to':
                        case 'allotted_upto':
                        case 'remarks':
                            $allottedInfo = $asset->assetallotedInfos ?? $asset->assetallotedInfos()->firstOrNew([]);
                            $allottedInfo->{$field} = $newValue;
                            $allottedInfo->save();
                            $hasAnyChanges = true;
                            break;

                        case 'amc_vendor':
                        case 'warranty_vendor':
                        case 'insurance_start_date':
                        case 'insurance_end_date':
                        case 'amc_start_date':
                        case 'amc_end_date':
                        case 'warranty_start_date':
                        case 'warranty_end_date':
                            $warrantyInfo = $asset->assetwarrantyInfos ?? $asset->assetwarrantyInfos()->firstOrNew([]);
                            $warrantyInfo->{$field} = $newValue;
                            $warrantyInfo->save();
                            $hasAnyChanges = true;
                            break;
                    }
                }

                if ($asset->getDirty()) {
                    $asset->save();
                }

                if ($hasAnyChanges) {
                    $updatedAssets[] = $assetId;
                }
            }

            if (!empty($errors)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation errors occurred',
                    'errors' => $errors
                ], 422);
            }

            return response()->json([
                'status' => true,
                'message' => 'Successfully updated ' . count($updatedAssets) . ' assets',
                'updated_count' => count($updatedAssets)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update assets: ' . $e->getMessage()
            ], 500);
        }
    }


}
