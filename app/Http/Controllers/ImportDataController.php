<?php

namespace App\Http\Controllers;
use App\Imports\AssetImport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class ImportDataController extends Controller
{
    public function add()
    {
        return view('pages.import-data.import-asset');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
            ]);
            
            $file = $request->file('file');
            
            // ✅ Generate unique file name
            $fileName = time() . '_' . $file->getClientOriginalName();
            
        // ✅ Save in public/uploads/imports
        $file->move(public_path('uploads/imports'), $fileName);
        
        // ✅ Full path for import
        $filePath = public_path('uploads/imports/' . $fileName);
        
        // ✅ Import
        $import = new AssetImport();
        Excel::import($import, $filePath);

        // ✅ Handle errors
        $failures = $import->failures();

        if ($failures->isNotEmpty()) {
            return back()->with([
                'import_errors' => $failures
            ]);
        }

        return back()->with('success_msg', 'Assets Imported Successfully');
    }

    public function downloadTemplate()
    {
        $filePath = public_path('templates/upload_multiple_assets.xlsx');

        if (!file_exists($filePath)) {
            abort(404, 'Template file not found');
        }

        return response()->download($filePath);
    }

    public function downloadLatest()
    {
        $path = public_path('uploads/imports');

        // Get all files
        $files = glob($path . '/*');

        if (empty($files)) {
            return back()->with('error', 'No files found');
        }

        // Get latest file (based on modified time)
        $latestFile = collect($files)->sortByDesc(function ($file) {
            return filemtime($file);
        })->first();

        return response()->download($latestFile);
    }
}
