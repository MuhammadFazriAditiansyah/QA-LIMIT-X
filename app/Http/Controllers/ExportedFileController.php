<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExportedFile;
use ZipArchive;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MikrobiologiAirExport;
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


    public function downloadMultipleAndExportExcel(Request $request)
    {
        $fileIds = $request->input('file_ids', []);
        if (empty($fileIds)) {
            return redirect()->back()->with('error', 'Tidak ada file yang dipilih.');
        }

        $zipFileName = 'files-' . time() . '.zip';
        $zipFilePath = storage_path('app/public/downloads/' . $zipFileName);

        if (!file_exists(storage_path('app/public/downloads'))) {
            mkdir(storage_path('app/public/downloads'), 0755, true);
        }

        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($fileIds as $id) {
                $exportedFile = ExportedFile::find($id);

                if (!$exportedFile || !Storage::disk('public')->exists('exports/' . $exportedFile->filename)) {
                    continue;
                }

                $filePath = storage_path('app/public/exports/' . $exportedFile->filename);

                $zip->addFile($filePath, $exportedFile->filename);
            }

            $zip->close();

            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            return redirect()->back()->with('error', 'Gagal membuat file ZIP.');
        }
    }
}
