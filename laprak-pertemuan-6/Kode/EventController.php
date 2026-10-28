<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        // 5 event terbaru
        $event_terbaru = Event::orderBy('tanggal_mulai', 'desc')
            ->take(5)
            ->get();

        // Mengambil filter dan pencarian
        $tipe_event = $request->tipe_event;
        $keyword = $request->keyword;

        // Menampilkan seluruh event
        $events = Event::all();

        // Filter berdasarkan tipe event
        if ($tipe_event && $tipe_event != 'Semua Tipe') {
            $events = Event::where('tipe_event', $tipe_event)->get();
        }

        // Pencarian berdasarkan nama event
        if ($keyword) {
            $events = $events->filter(function ($event) use ($keyword) {
                return stripos($event->nama_event, $keyword) !== false;
            });
        }

        // Statistik event
        $total_event = Event::count();

        $total_run = Event::where('tipe_event', 'Run')->count();

        $total_trail_run = Event::where('tipe_event', 'Trail Run')->count();

        $total_challenge = Event::where('tipe_event', 'Challenge')->count();

        return view('event', compact(
            'event_terbaru',
            'events',
            'tipe_event',
            'keyword',
            'total_event',
            'total_run',
            'total_trail_run',
            'total_challenge'
        ));
    }
}