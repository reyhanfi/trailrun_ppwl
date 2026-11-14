<?php

namespace App\Exports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class EventImportTemplate implements FromArray, WithHeadings, WithColumnFormatting
{
    public function array(): array
    {
        return [];
    }

    public function headings(): array
    {
        return array_keys(Event::validationRules());
    }

    public function columnFormats(): array
    {
        return ['D' => NumberFormat::FORMAT_TEXT, 'E' => NumberFormat::FORMAT_TEXT];
    }
}
