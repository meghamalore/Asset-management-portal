<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\AssetQrBarcode;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class BarcodeController extends Controller
{
    public function index()
    {
        $assets = Asset::select('id', 'asset_name', 'asset_code')->whereNull('status')->get();
        $aAssetQrBarcodessets = AssetQrBarcode::with('asset')
        ->select(
            'id',
            'asset_id',
            'asset_code',
            'qr_code',
            'barcode',
            'created_at'
        )
        ->get();
        return view('pages.administration.barcode-template.index',compact('assets','aAssetQrBarcodessets'));

    }

    public function store(Request $request)
    {
        $asset = Asset::findOrFail($request->asset_id);

        $alreadyExists = AssetQrBarcode::where('asset_id', $request->asset_id)
        ->first();

        if ($alreadyExists) {

            return response()->json([
                'status'  => false,
                'message' => 'QR Code already generated for this asset.'
            ]);

        }

        $assetName = $asset->asset_name;

        // Create folders if not exists
        if (!File::exists(public_path('uploads/qr'))) {
            File::makeDirectory(public_path('uploads/qr'), 0755, true);
        }

        if (!File::exists(public_path('uploads/barcode'))) {
            File::makeDirectory(public_path('uploads/barcode'), 0755, true);
        }

        $fileName = time();

        /*
        |--------------------------------------------------------------------------
        | QR Code Save
        |--------------------------------------------------------------------------
        */

        $qrPath = public_path('uploads/qr/qr_' . $fileName . '.png');

        QrCode::format('png')
            ->size(300)
            ->generate(
                $assetName . ' | ' . $request->asset_code,
                $qrPath
            );

        /*
        |--------------------------------------------------------------------------
        | Barcode Save
        |--------------------------------------------------------------------------
        */

        $barcodePath = public_path('uploads/barcode/barcode_' . $fileName . '.png');

        $barcode = file_get_contents(
            'https://barcode.tec-it.com/barcode.ashx?data=' .
            $request->asset_code .
            '&code=Code128'
        );

        File::put($barcodePath, $barcode);

        /*
        |--------------------------------------------------------------------------
        | Save Database
        |--------------------------------------------------------------------------
        */

        AssetQrBarcode::create([
            'asset_id'   => $request->asset_id,
            'asset_code' => $request->asset_code,
            'qr_code'    => 'uploads/qr/qr_' . $fileName . '.png',
            'barcode'    => 'uploads/barcode/barcode_' . $fileName . '.png',
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'QR and Barcode Generated Successfully'
        ]);
    }

    public function destroy($id)
    {
        $barcode = AssetQrBarcode::find($id);

        if (!$barcode) {
            return response()->json([
                'status' => false,
                'message' => 'Record not found'
            ], 404);
        }

        $barcode->delete();

        return response()->json([
                'status' => true,
                'message' => 'Deleted successfully'
            ]);
    }

    public function view($id)
    {
        $qr = AssetQrBarcode::with('asset')->findOrFail($id);

        return view('pages.administration.barcode-template.view', compact('qr'));
    }
}
