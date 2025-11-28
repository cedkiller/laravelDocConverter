<?php

namespace App\Services;

use App\Models\DocTbl;
use Illuminate\Support\Facades\Storage;

class indexServices {
    public static function convertDocToPdfAction($request) {
        // Fix typo: flie -> file
        $file = $request->file('file');
        
        // Store the uploaded file
        $path = $file->store('files', 'public');
        
        // Get the full storage path
        $fullPath = storage_path('app/public/' . $path);
        
        $pdfPath = null;
        
        if ($file->getClientOriginalExtension() === 'docx') {
            // Generate PDF output path
            $pdfFileName = pathinfo($path, PATHINFO_FILENAME) . '.pdf';
            $pdfPath = 'files/' . $pdfFileName;
            $fullPdfPath = storage_path('app/public/' . $pdfPath);
            
            // Get Python script path
            $pythonScript = base_path('convert.py');
            
            // Execute Python script
            $command = "python \"{$pythonScript}\" \"{$fullPath}\" \"{$fullPdfPath}\"";
            exec($command, $output, $returnVar);
            
            // Check if conversion was successful
            if ($returnVar !== 0 || !file_exists($fullPdfPath)) {
                $pdfPath = null;
            }
        }
        
        // Save to database
        DocTbl::create([
            'doc_name' => $file->getClientOriginalName(),
            'doc_docx_path' => $path,
            'doc_pdf_path' => $pdfPath
        ]);
        
        // Redirect back with success message
        $readDocTbl = DocTbl::all();
        return view('index', [
            'readDocTbl' => $readDocTbl,
            'exeConvertDocToPdfExe' => 1
        ]);
    }
}