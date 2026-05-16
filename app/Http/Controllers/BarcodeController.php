<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\AssetQrBarcode;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;


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
        $asset = Asset::findOrFail($request->id);


        $alreadyExists = AssetQrBarcode::where('asset_id', $request->id)
            ->first();

        if ($alreadyExists) {

            return response()->json([

                'status' => false,

                'already_generated' => true,

                'message' => 'QR Code already generated for this asset.',

                'data' => [

                    'asset_name' => $asset->asset_name,

                    'asset_code' => $alreadyExists->asset_code,

                    'qr' => asset($alreadyExists->qr_code),

                    'barcode' => asset($alreadyExists->barcode),
                ]
            ]);
        }

        $assetName = $asset->asset_name;

        $assetCode = $request->asset_code;

        $fileName = time();

        if (!File::exists(public_path('uploads/qr'))) {

            File::makeDirectory(public_path('uploads/qr'), 0755, true);
        }

        if (!File::exists(public_path('uploads/barcode'))) {

            File::makeDirectory(public_path('uploads/barcode'), 0755, true);
        }


        $qrFile = 'uploads/qr/qr_' . $fileName . '.png';

        $qrPath = public_path($qrFile);

        QrCode::format('png')
            ->size(300)
            ->generate(
                $assetName . ' | ' . $assetCode,
                $qrPath
            );


        $barcodeFile = 'uploads/barcode/barcode_' . $fileName . '.png';

        $barcodePath = public_path($barcodeFile);

        $barcode = file_get_contents(
            'https://barcode.tec-it.com/barcode.ashx?data=' .
            urlencode($assetCode) .
            '&code=Code128'
        );

        File::put($barcodePath, $barcode);

        AssetQrBarcode::create([

            'asset_id' => $request->id,

            'asset_code' => $assetCode,

            'qr_code' => $qrFile,

            'barcode' => $barcodeFile,
        ]);


        return response()->json([

            'status' => true,

            'already_generated' => false,

            'message' => 'QR and Barcode Generated Successfully',

            'data' => [

                'asset_name' => $assetName,

                'asset_code' => $assetCode,

                'qr' => asset($qrFile),

                'barcode' => asset($barcodeFile),
            ]
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

    public function multipleQrGenerate(Request $request)
    {
        $request->validate([
            'asset_ids' => 'required|array',
            'asset_ids.*' => 'exists:assets,id'
        ]);

        $responseData = [];
        $alreadyExists = [];

        // Create folder if not exists
        if (!File::exists(public_path('uploads/qr'))) {

            File::makeDirectory(public_path('uploads/qr'), 0755, true);

        }

        foreach ($request->asset_ids as $assetId) {

            $asset = Asset::find($assetId);

            // Check already generated
            $exists = AssetQrBarcode::where('asset_id', $assetId)->first();

            if ($exists) {

                $alreadyExists[] = [
                    'asset_name' => $asset->asset_name,
                    'asset_code' => $asset->asset_code,
                    'qr_code'    => asset($exists->qr_code),
                ];

                continue;
            }

            // File name
            $fileName = time() . '_' . $asset->asset_code . '.png';

            // Save path
            $savePath = public_path('uploads/qr/' . $fileName);

            // Generate QR
            QrCode::format('png')
                ->size(300)
                ->generate($asset->asset_code, $savePath);

            // DB Save
            $qr = AssetQrBarcode::create([
                'asset_id'     => $asset->id,
                'asset_code'     => $asset->asset_code,
                'qr_code'      => 'uploads/qr/' . $fileName
            ]);

            // Response Data
            $responseData[] = [
                'asset_name' => $asset->asset_name,
                'asset_code' => $asset->asset_code,
                'qr_code'    => asset($qr->qr_code),
            ];
        }

        return response()->json([

            'status' => true,

            'generated_assets' => $responseData,

            'already_generated' => $alreadyExists,

            'message' => 'QR Codes Generated Successfully'

        ]);
    }

    public function downloadPDF(Request $request)
    {
        $qrData = json_decode($request->qrData, true);
        // dd($qrData);
        $pdf = PDF::loadView('pdf.multiple-qr', compact('qrData'));

        return $pdf->download('qr-codes.pdf');
    }
}
