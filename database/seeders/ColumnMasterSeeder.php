<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ColumnMaster;
use Illuminate\Support\Str;

class ColumnMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $columns = [
            "Asset Code",
            "Asset Name",
            "Brand",
            "Model",
            "Serial No",
            "Vendor Name",
            "Created Date",
            "Created By",
            "Description",
            "Linked Asset",
            "Self Owned / Partner",
            "Category",
            "Location",
            "Status",
            "Department",
            "Condition",
            "Allotted Upto",
            "Transferred To",
            "PO Number",
            "Invoice Date",
            "Purchase Price",
            "Capitalization Date",
            "Capitalization Price",
            "Invoice No",
            "End Of Life",
            "Depreciation%",
            "Scrap Value",
            "Upload Files",
            "Asset Image",
            "Remarks",
            "Last Scanned Date",
            "Last Scanned By",
            "Purchase Date",
            "Partner",
            "AMC End Date",
            "AMC Start Date",
            "AMC Vendor",
            "Warranty End Date",
            "Warranty Start Date",
            "Warranty Vendor",
            "Insurance End Date",
            "Insurance Start Date",
            "Modified By",
            "Modified Date",
            "Income Tax Depreciation%",
            "Accumulated Depreciation",
            "Parent Asset"
        ];

        foreach ($columns as $column) {
            ColumnMaster::create([
                'column_name' => $column,
                'column_key' => Str::slug($column, '_'),
                'is_default' => 1 // or customize
            ]);
        }
    }
}
