<?php

namespace App\Imports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EventsImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    public function model(array $row): Event
    {
        return new Event(array_intersect_key($row, $this->rules()));
    }

    public function prepareForValidation(array $row, int $index): array
    {
        foreach (['tanggal_mulai', 'tanggal_selesai'] as $column) {
            $value = $row[$column] ?? null;
            if (is_numeric($value) && $value >= 1 && $value <= 2958465) {
                $row[$column] = Date::excelToDateTimeObject((float) $value)->format('Y-m-d');
            }
        }

        return $row;
    }

    public function rules(): array
    {
        return array_replace(Event::validationRules(), [
            'tanggal_selesai' => 'required|date|after_or_equal:*.tanggal_mulai',
        ]);
    }
}
