<?php

namespace App\Http\Controllers;

use App\Exports\EventRegistrationsExport;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class EventRegistrationController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $request->validate(['ktp' => 'required|image|mimes:jpg,jpeg,png|max:2048']);
        $userId = $request->user()->id;

        if ($event->registrations()->where('user_id', $userId)->exists()) {
            return back()->withErrors(['ktp' => 'Kamu sudah mendaftar untuk event ini.']);
        }

        $disk = Storage::disk('local');
        $path = $request->file('ktp')->store('ktp', 'local');
        if ($path === false) {
            return back()->withErrors(['ktp' => 'Foto KTP gagal disimpan. Silakan coba lagi.']);
        }

        try {
            $event->registrations()->create(['user_id' => $userId, 'ktp_path' => $path]);
        } catch (UniqueConstraintViolationException) {
            $disk->delete($path);

            return back()->withErrors(['ktp' => 'Kamu sudah mendaftar untuk event ini.']);
        } catch (Throwable $exception) {
            $disk->delete($path);

            throw $exception;
        }

        return redirect()->route('event.show', $event)
            ->with('status', 'Pendaftaran berhasil. Status awal Pending.');
    }

    public function index(Event $event)
    {
        $registrations = $event->registrations()->with('user')->latest('id')->paginate(15);

        return view('event.registrations', compact('event', 'registrations'));
    }

    public function update(Request $request, EventRegistration $registration)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in([EventRegistration::ACCEPTED, EventRegistration::REJECTED])],
        ]);
        $registration->update($validated);

        return redirect()->route('event.registrations.index', $registration->event_id)
            ->with('status', 'Status pendaftaran diperbarui.');
    }

    public function download(EventRegistration $registration)
    {
        $disk = Storage::disk('local');
        abort_unless($disk->exists($registration->ktp_path), 404);

        $extension = pathinfo($registration->ktp_path, PATHINFO_EXTENSION);

        return $disk->download($registration->ktp_path, "ktp-{$registration->id}.{$extension}", [
            'Cache-Control' => 'private, no-store',
        ]);
    }

    public function export(Event $event)
    {
        return Excel::download(new EventRegistrationsExport($event), "peserta-event-{$event->id}.xlsx");
    }
}
