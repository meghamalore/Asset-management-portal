<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Location;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Validation\Rule;

// class AssetImport implements ToCollection
// {
//     /**
//     * @param Collection $collection
//     */
//     public function collection(Collection $collection)
//     {
//         //
//     }
// }

class AssetImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public function model(array $row)
    {
        $category = Category::where('category_name', $row['category'])->first();
        $location = Location::where('name', $row['location'])->first();

        return new Asset([
            'asset_name' => $row['asset_name'],
            'asset_code' => $row['asset_code'],
            'category_id' => $category->id ?? null,
            'location_id' => $location->id ?? null,
            'cwip_invoice_id' => $row['cwip_invoice_id'] ?? null,
            'status' => $row['status'] ?? null,
            'condition' => $row['condition'] ?? null,
            'brand' => $row['brand'] ?? null,
            'model' => $row['model'] ?? null,
            'description' => $row['description'] ?? null,
            'serial_no' => $row['serial_no'] ?? null,
            'po_number' => $row['po_number'] ?? null,
        ]);
    }

    // ✅ Validation Rules
    public function rules(): array
    {
        return [
            '*.asset_name' => 'required',
            '*.asset_code' => 'required|unique:assets,asset_code',
            '*.category' => 'required',
            '*.location' => 'required',
        ];
    }

    // ✅ Custom Error Messages
    public function customValidationMessages()
    {
        return [
            '*.asset_name.required' => 'Asset name is required',
            '*.asset_code.required' => 'Asset code is required',
            '*.asset_code.unique' => 'Asset code already exists',
            '*.category.required' => 'Category is required',
            '*.location.required' => 'Location is required',
        ];
    }
}