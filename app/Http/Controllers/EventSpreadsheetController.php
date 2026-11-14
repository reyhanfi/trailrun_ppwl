<?php

namespace App\Http\Controllers;

use App\Exports\EventImportTemplate;
use App\Imports\EventsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use PhpOffice\PhpSpreadsheet\Reader\Exception as ReaderException;

class EventSpreadsheetController extends Controller
{
    public function import(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:xlsx,csv,txt|extensions:xlsx,csv|max:5120']);
        $file = $request->file('file');
        $format = strtolower($file->getClientOriginalExtension()) === 'csv'
            ? ExcelFormat::CSV
            : ExcelFormat::XLSX;

        try {
            Excel::import(new EventsImport, $file, null, $format);
        } catch (ValidationException $exception) {
            $failure = $exception->failures()[0];

            return back()->withErrors([
                'file' => "Baris {$failure->row()}: ".implode(' ', $failure->errors()),
            ]);
        } catch (ReaderException) {
            return back()->withErrors(['file' => 'Berkas tidak dapat dibaca. Gunakan template import.']);
        }

        return redirect()->route('event.index')->with('pesan', 'Data event berhasil diimpor.');
    }

    public function template()
    {
        return Excel::download(new EventImportTemplate, 'template-import-event.xlsx');
    }
}
