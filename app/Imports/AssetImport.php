<?php

namespace App\Imports;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Location;
use App\Models\Status;
use App\Models\AssetAdditionalInfos;
use App\Models\AssetPurchaseInfos;
use App\Models\AssetFinacialInfos;
use App\Models\AssetAllotedInfos;
use App\Models\AssetWarrantyInfos;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\Importable;


class AssetImport implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    SkipsOnFailure
{
    use Importable, SkipsFailures;

    /**
     * Insert Data
     */
    public function model(array $row)
    {
        if (
            empty($row['asset_name']) &&
            empty($row['asset_code']) &&
            empty($row['category']) &&
            empty($row['location'])
        ) {
            throw new \Exception('Blank row found after header');
        }

        $category = Category::where('name',$row['category'] ?? null)->first();

        $location = Location::where('name',$row['location'] ?? null)->first();

        $status = Status::where('status_name',$row['status'] ?? null)->first();

        // Insert Asset
        $asset = Asset::create([

            'asset_name' => trim($row['asset_name']) ?? null,

            'asset_code' => $row['asset_code'] ?? null,

            'category_id' => $category->id ?? null,

            'location_id' => $location->id ?? null,

            'cwip_invoice_id' => $row['cwip_invoice_id'] ?? null,

            'status' => $status->id ?? null,

            // 'mac_address' => $row['mac_address'] ?? null,


        ]);

        // Insert Additional Info
        AssetAdditionalInfos::create([

            'asset_id' => $asset->id,

            'condition' => $row['condition'] ?? null,

            'brand' => $row['brand'] ?? null,

            'model' => $row['model'] ?? null,

            'description' => $row['description'] ?? null,

            'serial_no' => $row['serial_no'] ?? null,

        ]);

        AssetPurchaseInfos::create([

            'asset_id' => $asset->id,

            'vendor_name' => $row['vendor_name'] ?? null,

            'invoice_date' => $row['invoice_date'] ?? null,

            'invoice_no' => $row['invoice_no'] ?? null,

            'purchase_date' => $row['purchase_price'] ?? null,

            // 'is_self_owned' => $row['is_self_owned'] ?? null,

            // 'end_of_life' => $row['end_of_life'] ?? null,

            'asset_po_number' => $row['asset_po_number'] ?? null,

        ]);

        AssetFinacialInfos::create([

            'asset_id' => $asset->id,

            'capitalization_price' => $row['capitalization_price'] ?? null,

            'capitalization_date' => $row['capitalization_date'] ?? null,

            'depreciation_percent' => $row['depreciation_percent'] ?? null,

            'accumulated_depreciation' => $row['accumulated_depreciation'] ?? null,

            'scrap_value' => $row['scrap_value'] ?? null,

            'income_tax_depreciation_percent' => $row['income_tax_depreciation_percent'] ?? null,
            
            // 'end_of_life' => $row['end_of_life'] ?? null,

        ]);

        AssetAllotedInfos::create([

            'asset_id' => $asset->id,

            'department' => $row['vendor_name'] ?? null,

            'transferred_to' => $row['invoice_date'] ?? null,

            'allotted_upto' => $row['invoice_no'] ?? null,

            'remarks' => $row['purchase_price'] ?? null,

        ]);

        AssetWarrantyInfos::create([

            'asset_id' => $asset->id,

            'amc_vendor' => $row['amc_vendor'] ?? null,

            'warranty_vendor' => $row['warranty_vendor'] ?? null,

            'insurance_start_date' => $row['insurance_start_date'] ?? null,

            'insurance_end_date' => $row['insurance_end_date'] ?? null,

            'amc_start_date' => $row['amc_start_date'] ?? null,

            'amc_end_date' => $row['amc_end_date'] ?? null,
            
            'warranty_start_date' => $row['warranty_start_date'] ?? null,

            'warranty_end_date' => $row['warranty_end_date'] ?? null,

        ]);

        return $asset;
    }

    public function prepareForValidation($data, $index)
    {
        return [

            'asset_name' => trim($data['asset_name'] ?? ''),

            'asset_code' => trim($data['asset_code'] ?? ''),

            'category' => trim($data['category'] ?? ''),

            'location' => trim($data['location'] ?? ''),

            'status' => trim($data['status'] ?? ''),

            'serial_no' => trim($data['serial_no'] ?? ''),

            // 'mac_address' => trim($data['mac_address'] ?? ''),


        ];
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        return [

            '*.asset_name' => 'required',

            '*.asset_code' => 'required|unique:assets,asset_code',

            '*.category' => 'required|exists:categories,name',

            '*.location' => 'required|exists:locations,name',

            '*.status' => 'required|exists:statuses,status_name',
            
            '*.serial_no' => 'required|unique:asset_additional_infos,serial_no',

            // '*.mac_address' => 'required|unique:assets,mac_address'

        ];
    }

    /**
     * Custom Error Messages
     */
    public function customValidationMessages()
    {
        return [

            '*.asset_name.required' => 'Asset Name is required',

            '*.asset_code.required' => 'Asset Code is required',

            '*.asset_code.unique' => 'Asset Code already exists',

            '*.category.required' => 'Category is required',

            '*.category.exists' => 'Category name not found',

            '*.location.required' => 'Location is required',

            '*.location.exists' => 'Location name not found',

            '*.status.required' => 'Status is required',

            '*.status.exists' => 'Status name not found',

            '*.serial_no.unique' => 'Serial Number already exists',

            // '*.mac_address.required' => 'MAC Address is required',

            // '*.mac_address.unique' => 'MAC Address already exists',

        ];
    }
}