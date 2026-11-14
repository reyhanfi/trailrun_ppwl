<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->filled('tipe_event') &&
            $request->tipe_event !== 'Semua Tipe') {
            $query->where('tipe_event', $request->tipe_event);
        }

        if ($request->filled('keyword')) {
            $query->where(
                'nama_event',
                'like',
                '%' . $request->keyword . '%'
            );
        }

        $events = (clone $query)
            ->orderBy('tanggal_mulai')
            ->paginate(5)
            ->withQueryString();

        $total_event = Event::count();
        $total_run = Event::where('tipe_event', 'Run')->count();
        $total_trail_run = Event::where('tipe_event', 'Trail Run')->count();
        $total_challenge = Event::where('tipe_event', 'Challenge')->count();
        $total_slot_peserta = (int) Event::sum('slot_peserta');

        $tipe_event = $request->tipe_event;
        $keyword = $request->keyword;

        return view('event', compact(
            'events',
            'tipe_event',
            'keyword',
            'total_event',
            'total_run',
            'total_trail_run',
            'total_challenge',
            'total_slot_peserta'
        ));
    }

    public function show(Request $request, Event $event)
    {
        $registration = $event->registrations()->where('user_id', $request->user()->id)->first();

        return view('event.show', compact('event', 'registration'));
    }

    public function create()
    {
        return view('event.create', ['event' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            Event::validationRules(),
            $this->messages()
        );

        Event::create($validated);

        return redirect()->route('event.index')
            ->with('pesan', 'Event berhasil ditambahkan.');
    }

    public function edit(Event $event)
    {
        return view('event.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate(
            Event::validationRules(),
            $this->messages()
        );

        $event->update($validated);

        return redirect()->route('event.index')
            ->with('pesan', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        try {
            $event->delete();
        } catch (\Illuminate\Database\QueryException $exception) {
            if (!$event->registrations()->exists()) {
                throw $exception;
            }

            return redirect()->route('event.index')
                ->with('pesan', 'Event yang memiliki pendaftaran tidak dapat dihapus.');
        }

        return redirect()->route('event.index')
            ->with('pesan', 'Event berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $hasil = Event::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where(
                    'nama_event',
                    'like',
                    '%' . $keyword . '%'
                );
            })
            ->orderBy('tanggal_mulai')
            ->paginate(5)
            ->withQueryString();

        return view('event.search', compact('hasil', 'keyword'));
    }

    private function messages(): array
    {
        return [
            'nama_event.required' => 'Nama event wajib diisi.',
            'nama_event.max' => 'Nama event maksimal 255 karakter.',
            'penyelenggara.required' => 'Nama penyelenggara wajib diisi.',
            'penyelenggara.max' => 'Nama penyelenggara maksimal 255 karakter.',
            'tipe_event.required' => 'Tipe event wajib dipilih.',
            'tipe_event.in' => 'Tipe event yang dipilih tidak valid.',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_mulai.date' => 'Tanggal mulai tidak valid.',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi.',
            'tanggal_selesai.date' => 'Tanggal selesai tidak valid.',
            'tanggal_selesai.after_or_equal' =>
                'Tanggal selesai harus sama atau setelah tanggal mulai.',
            'slot_peserta.required' => 'Slot peserta wajib diisi.',
            'slot_peserta.integer' => 'Slot peserta harus berupa bilangan bulat.',
            'slot_peserta.min' => 'Slot peserta minimal 1.',
            'slot_peserta.max' => 'Slot peserta maksimal 1.000.000.',
        ];
    }
}
