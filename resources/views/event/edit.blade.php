@extends('auth.layouts')

@section('title', 'Edit Event')

@section('content')
    <div class="card" style="max-width: 760px;">
        <div class="eyebrow">Perbarui Event</div>
        <h1>Edit Event</h1>
        <p>Periksa kembali detail event sebelum menyimpan perubahan.</p>

        <form action="{{ route('event.update', $event->id) }}" method="POST" class="event-form">
            @csrf
            @method('PUT')

            @include('event._form')

            <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 22px;">
                <button type="submit" class="primary-button">Simpan Perubahan</button>
                <a href="{{ route('event.index') }}" class="ghost-button">Kembali ke daftar</a>
            </div>
        </form>
    </div>
@endsection