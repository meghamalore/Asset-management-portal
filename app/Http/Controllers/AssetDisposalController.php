<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetDisposal;
use App\Models\Asset;
use App\Models\AssetDisposalImages;
use App\Models\AssetDisposalItem;


class AssetDisposalController extends Controller
{
    public function store(Request $request)
    {

        //  2. Create main disposal
        $disposal = AssetDisposal::create([
            'reason' => $request->reason,
            'discard_date' => $request->date,
            'vendor_name' => $request->vendor_name,
            'remark' => $request->remark,
            'tax_group' => $request->tax_group,
        ]);

        //  3. Loop assets
        foreach ($request->assets as $asset) {

            AssetDisposalItem::create([
                'asset_disposal_id' => $disposal->id,
                // 'asset_id' => 

                'sold_value' => $asset['sold_value'] ?? 0,
                'purchase_price' => $asset['purchase_price'] ?? 0,
                'price_difference' => $asset['price_difference'] ?? 0,

                'location_id' => $asset['location_id'] ?? null,
                'sub_location_id' => $asset['sub_location_id'] ?? null,
            ]);

            //  4. Update asset status (optional but recommended)
            Asset::where('asset_code', $asset['asset_code'])
                ->update(['status' => 'disposed']);
        }

        //  5. File Upload
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('asset_disposals', 'public');
            }
        }

        return redirect()->back()->with('success', 'Assets disposed successfully');
    }

    
}
