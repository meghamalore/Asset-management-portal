<?php
 
namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
 
class AssetsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $assets;
 
    public function __construct($assets)
    {
        $this->assets = $assets;
    }
 
    public function collection()
    {
        return $this->assets;
    }
 
    public function map($asset): array
    {
        return [
            $asset->id,
            $asset->asset_name,
            $asset->asset_code,
            $asset->category->name ?? '',
            $asset->created_at,
            $asset->location->name ?? '',
            $asset->created_by ?? '',
            $asset->status->status_name ?? '',
            $asset->updated_at,
            $asset->updated_by ?? '',
            $asset->additionalInfo->condition ?? '',
            $asset->additionalInfo->brand ?? '',
            $asset->additionalInfo->model ?? '',
            $asset->additionalInfo->description ?? '',
            $asset->additionalInfo->serial_no ?? '',
            $asset->purchaseInfo->vendor_name ?? '',
            $asset->purchaseInfo->asset_po_number ?? '',
            $asset->purchaseInfo->invoice_date ?? '',
            $asset->purchaseInfo->invoice_no ?? '',
            $asset->purchaseInfo->purchase_date ?? '',
            $asset->purchaseInfo->purchase_price ?? '',
            $asset->purchaseInfo->is_self_owned == 1 ? 'Yes' : 'No',
            $asset->purchaseInfo->partner ?? '',
            $asset->finacialInfos->capitalization_price ?? '',
            $asset->finacialInfos->end_of_life ?? '',
            $asset->finacialInfos->capitalization_date ?? '',
            $asset->finacialInfos->depreciation_percent ?? '',
            $asset->finacialInfos->scrap_value ?? '',
            $asset->finacialInfos->accumulated_depreciation ?? '',
            $asset->finacialInfos->depreciation ?? '',
            $asset->finacialInfos->income_tax_depreciation ?? '',
            $asset->assetallotedInfos->department ?? '',
            $asset->assetallotedInfos->transferred_to ?? '',
            $asset->assetallotedInfos->allotted_upto ?? '',
            $asset->assetallotedInfos->remarks ?? '',
            $asset->assetwarrantyInfos->amc_vendor ?? '',
            $asset->assetwarrantyInfos->warranty_vendor ?? '',
            $asset->assetwarrantyInfos->insurance_start_date ?? '',
            $asset->assetwarrantyInfos->insurance_end_date ?? '',
            $asset->assetwarrantyInfos->amc_start_date ?? '',
            $asset->assetwarrantyInfos->warranty_end_date ?? '',
            $asset->assetwarrantyInfos->amc_end_date ?? '',
            $asset->assetwarrantyInfos->warranty_start_date ?? '',
        ];
    }
 
    public function headings(): array
    {
        return [
            'ID',
            'Asset Name',
            'Asset Code',
            'Category',
            'Created At',
            'Location',
            'Created By',
            'Status',
            'Modified Date',
            'Modified By',
            'Condition',
            'Brand',
            'Model',
            'Description',
            'Sr No.',
            'Vendor Name',
            'PO Number',
            'Invoice Date',
            'Invoice No',
            'Purchase Date',    
            'Purchase Price',  
            'Self Owned / Partner',
            'Partner',
            'Capitalization Price',
            'End Of Life',  
            'Capitalization Date',  
            'Depreciation%',    
            'Scrap Value',  
            'Accumulated Depreciation',
            'Depreciation',
            'Income Tax Depreciation%',
            'Department',  
            'Transferred To',  
            'Allotted Upto',
            'Remarks',  
            'AMC Vendor',  
            'Warranty Vendor',  
            'Insurance Start Date',
            'Insurance End Date',  
            'AMC Start Date',  
            'Warranty End Date',    
            'AMC End Date',
            'Warranty Start Date',
        ];
    }
}
 