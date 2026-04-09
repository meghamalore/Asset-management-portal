<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Asset;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AssetsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Asset::select(
            'id',
            'asset_name',
            'asset_code',
            'category_id',
            'location_id',
            'status_id',
            'created_at'
        )->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Asset Name',
            'Asset Code',
            'Category',
            'Location',
            'Status',
            'Created At'
        ];
    }
    
}
