<?php

namespace App\Exports;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;

class EventRegistrationsExport extends StringValueBinder implements FromQuery, WithMapping, WithHeadings, WithCustomValueBinder
{
    public function __construct(private Event $event) {}

    public function query(): Builder
    {
        return EventRegistration::query()
            ->where('event_id', $this->event->id)
            ->with('user')
            ->orderBy('id');
    }

    public function headings(): array
    {
        return ['Nama', 'Email', 'Event', 'Status', 'Tanggal Daftar'];
    }

    public function map($registration): array
    {
        return [
            $registration->user->name,
            $registration->user->email,
            $this->event->nama_event,
            $registration->status,
            $registration->created_at->format('Y-m-d H:i'),
        ];
    }
}
