<?php

namespace App\Http\Controllers;

use App\Imports\AssetImport;
use App\Imports\TicketImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
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

        // Unique file name
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Save file
        $file->move(public_path('uploads/imports/asset'), $fileName);

        // Full path
        $filePath = public_path('uploads/imports/asset/' . $fileName);

        // Read Excel Data
        $data = Excel::toCollection(null, $filePath);

        // Check sheet exists
        if (!isset($data[0])) {

            return redirect()->route('import-asset')->with('error_msg', 'Excel sheet is empty');
        }

        // Check rows after header
        if (count($data[0]) <= 1) {

            return redirect()->route('import-asset')->with('error_msg', 'No data found');
        }

        // Import object
        $import = new AssetImport();

        // Import excel
        Excel::import($import, $filePath);

        // Validation Failures
        $failures = [];

        if ($import->failures()->isNotEmpty()) {

            foreach ($import->failures() as $failure) {

                $failures[] = [

                    'row' => $failure->row(),

                    'attribute' => $failure->attribute(),

                    'errors' => implode(', ', $failure->errors()),

                ];
            }

            return redirect()->route('import-asset')->with('error_msg', 'Validation errors found')->with('failures', $failures);
        }

        
        return redirect()->route('import-asset')->with('success_msg', 'Assets Imported Successfully');

    
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
        $path = public_path('uploads/imports/asset');

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

    public function addTicket()
    {
        return view('pages.import-data.import-tickets');
    }

    public function importTicket(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        $file = $request->file('file');

        // Unique file name
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Save file
        $file->move(public_path('uploads/imports/ticket'), $fileName);

        // Full path
        $filePath = public_path('uploads/imports/ticket/' . $fileName);

        // Read Excel Data
        $data = Excel::toCollection(null, $filePath);

        // Check sheet exists
        if (!isset($data[0])) {

            return redirect()->route('import-ticket')->with('error_msg', 'Excel sheet is empty');
        }

        // Check rows after header
        if (count($data[0]) <= 1) {

            return redirect()->route('import-ticket')->with('error_msg', 'No data found');
        }

        // Import object
        $import = new TicketImport();

        // Import excel
        Excel::import($import, $filePath);

        // Validation Failures
        $failures = [];

        if ($import->failures()->isNotEmpty()) {

            foreach ($import->failures() as $failure) {

                $failures[] = [

                    'row' => $failure->row(),

                    'attribute' => $failure->attribute(),

                    'errors' => implode(', ', $failure->errors()),

                ];
            }

            return redirect()->route('import-ticket')->with('error_msg', 'Validation errors found')->with('failures', $failures);
        }

        
        return redirect()->route('import-ticket')->with('success_msg', 'Tickets Imported Successfully');

    
    }

    public function downloadTemplateTicket()
    {
        $filePath = public_path('templates/upload_multiple_ticket.xlsx');

        if (!file_exists($filePath)) {
            abort(404, 'Template file not found');
        }

        return response()->download($filePath);
    }

    public function downloadLatestTicket()
    {
        $path = public_path('uploads/imports/ticket');

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
