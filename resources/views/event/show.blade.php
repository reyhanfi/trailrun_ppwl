@extends('auth.layouts')

@section('title', 'Detail Event')

@section('content')
    <section class="page-header">
        <div>
            <p class="eyebrow">Detail Event</p>
            <h1>{{ $event->nama_event }}</h1>
        </div>
        <a class="ghost-button" href="{{ route('event.index') }}">Kembali ke Daftar</a>
    </section>

    <div class="panel">
        <dl class="event-details">
            <div>
                <dt>Penyelenggara</dt>
                <dd>{{ $event->penyelenggara }}</dd>
            </div>
            <div>
                <dt>Tipe Event</dt>
                <dd>{{ $event->tipe_event }}</dd>
            </div>
            <div>
                <dt>Jadwal</dt>
                <dd>{{ $event->tanggal_mulai->format('d-m-Y') }} sampai {{ $event->tanggal_selesai->format('d-m-Y') }}</dd>
            </div>
            <div>
                <dt>Slot Peserta</dt>
                <dd>{{ number_format($event->slot_peserta, 0, ',', '.') }} peserta</dd>
            </div>
        </dl>
    </div>

    <section class="panel" style="margin-top: 22px;">
        <h2>Pendaftaran Peserta</h2>
        @if ($registration)
            <p>Status pendaftaran: <strong>{{ $registration->status }}</strong></p>
        @else
            <form action="{{ route('event.registrations.store', $event) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="field-group">
                    <label for="ktp">Unggah Foto KTP</label>
                    <input type="file" id="ktp" name="ktp" accept="image/jpeg,image/png" required aria-describedby="ktp-help">
                    <p id="ktp-help" class="section-note">JPG atau PNG, maksimal 2 MB.</p>
                    @error('ktp')
                        <div class="error" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <button class="primary-button" type="submit">Daftar Event</button>
            </form>
        @endif
    </section>
@endsection
