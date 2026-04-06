<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetDisposal;
use App\Models\Asset;
use App\Models\AssetDisposalImages;
use App\Models\AssetDisposalItem;
use App\Models\AssetFiles;


class AssetDisposalController extends Controller
{
    public function store(Request $request)
    {

        try {
            // 2. Create main disposal
            $disposal = AssetDisposal::create([
                'reason' => $request->reason,
                'discard_date' => $request->date,
                'vendor_name' => $request->vendor_name,
                'remark' => $request->remark,
                'tax_group' => $request->tax_group,
            ]);

            // 3. Loop assets
            foreach ($request->assets as $asset) {

                AssetDisposalItem::create([
                    'asset_disposal_id' => $disposal->id,
                    'asset_id' => \App\Models\Asset::where('asset_code', $asset['asset_code'])->value('id'),

                    'sold_value' => $asset['sold_value'] ?? 0,
                    'purchase_price' => $asset['purchase_price'] ?? 0,
                    'price_difference' => $asset['price_difference'] ?? 0,

                    'location_id' => $asset['location_id'] ?? null,
                    'sub_location_id' => $asset['sub_location_id'] ?? null,
                ]);

                // 4. Update asset status
                Asset::where('asset_code', $asset['asset_code'])
                    ->update(['status' => 'disposed']);
            }

            // 5. Handle file uploads
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $path = $file->store('asset_files', 'public');

                    AssetDisposalImages::create([
                        'asset_id' => $disposal->id,
                        'file_path' => $path
                    ]);
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Assets disposed successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    
}
