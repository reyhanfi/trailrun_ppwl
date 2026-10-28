@extends('auth.layouts')

@section('title', 'Tambah Event')

@section('content')
    <div class="card" style="max-width: 760px;">
        <div class="eyebrow">Tambah Event Baru</div>
        <h1>Tambah Event</h1>
        <p>Lengkapi informasi event untuk memudahkan pengelolaan jadwal dan peserta.</p>

        <form action="{{ route('event.store') }}" method="POST" class="event-form">
            @csrf
            @include('event._form')

            <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 22px;">
                <button type="submit" class="primary-button">Simpan</button>
                <a href="{{ route('event.index') }}" class="ghost-button">Kembali ke daftar</a>
            </div>
        </form>
    </div>
@endsection