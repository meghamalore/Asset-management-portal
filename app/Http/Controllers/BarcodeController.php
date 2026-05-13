<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubLocation;
use App\Models\Asset;
use App\Models\AssetQrBarcode;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class BarcodeController extends Controller
{
    public function index()
    {
        $assets = Asset::select('id', 'asset_name', 'asset_code')->whereNull('status')->get();
        return view('pages.administration.barcode-template.index',compact('assets'));

    }

    public function store(Request $request)
    {
        $asset = Asset::findOrFail($request->asset_id);

        $assetName = $asset->asset_name;

        $uploadPath = public_path('uploads');

        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        $fileName = time();

        // QR Code
        $qrImage = QrCode::format('png')
            ->size(300)
            ->generate($assetName . ' | ' . $request->asset_code);

        $qrPath = 'uploads/qr/qr_' . $fileName . '.png';

        file_put_contents(public_path($qrPath), $qrImage);

        // Barcode URL
        $barcodePath = 'uploads/barcode/barcode_' . $fileName . '.png';

        $barcodeUrl = 'https://barcode.tec-it.com/barcode.ashx?data=' . $request->asset_code . '&code=Code128';

        file_put_contents(
            public_path($barcodePath),
            file_get_contents($barcodeUrl)
        );

        AssetQrBarcode::create([
            'asset_id' => $request->asset_id,
            'asset_code' => $request->asset_code,
            'qr_code' => $qrPath,
            'barcode' => $barcodePath
        ]);

        return response()->json([
                'status' => true,
                'message' => 'QR and Barcode Generated Successfully'
            ]);
    }
}
