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

    public function create()
    {
        return view('event.create', ['event' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            $this->rules(),
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
            $this->rules(),
            $this->messages()
        );

        $event->update($validated);

        return redirect()->route('event.index')
            ->with('pesan', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

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

    private function rules(): array
    {
        return [
            'nama_event' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'tipe_event' => 'required|in:Run,Trail Run,Challenge',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'slot_peserta' => 'required|integer|min:1|max:1000000',
        ];
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
