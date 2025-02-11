<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExportedFile;
use ZipArchive;
use Illuminate\Support\Facades\Storage;

class ExportedFileController extends Controller
{
    public function index(Request $request)
    {
        $query = ExportedFile::query();

        if ($request->filled('specific_date')) {
            $query->whereDate('created_at', $request->specific_date);
        }

        $files = $query->orderBy('created_at', 'desc')->get();
        return view('exports.exported_files', compact('files'));
    }

    public function downloadMultiple(Request $request)
    {
        $fileIds = $request->input('file_ids', []);
        if (empty($fileIds)) {
            return redirect()->back()->with('error', 'Tidak ada file yang dipilih.');
        }

        $files = ExportedFile::whereIn('id', $fileIds)->get();
            dd($files);
        if ($files->isEmpty()) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        $zipFileName = 'files-' . time() . '.zip';
        $zipFilePath = storage_path('app/public/downloads/' . $zipFileName);


        if (!file_exists(storage_path('app/public/downloads'))) {
            mkdir(storage_path('app/public/downloads'), 0755, true);
        }

        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
            foreach ($files as $file) {
                $filePath = storage_path('app/public/' . $file->path);
                if (file_exists($filePath)) {
                    $zip->addFile($filePath, basename($filePath));
                }
            }
            $zip->close();
        } else {
            return redirect()->back()->with('error', 'Gagal membuat file ZIP.');
        }

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

}
