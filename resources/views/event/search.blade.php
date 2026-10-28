@extends('auth.layouts')

@section('title', 'Pencarian Event')

@section('content')
    <div class="panel search-panel">
        <div class="page-header" style="margin-bottom: 18px;">
            <div>
                <p class="eyebrow">Pencarian Event</p>
                <h1>Pencarian Event Trail Run</h1>
            </div>
            <div class="header-actions">
                <a href="{{ route('event.index') }}" class="ghost-button">Kembali ke daftar</a>
            </div>
        </div>

        <form action="{{ route('event.search') }}" method="GET" class="search-form">
            <div class="field-group">
                <label for="keyword">Nama Event</label>
                <input
                    type="text"
                    name="keyword"
                    id="keyword"
                    value="{{ $keyword }}"
                    placeholder="Masukkan nama event"
                >
            </div>

            <button type="submit" class="secondary-button">Cari</button>
            <a href="{{ route('event.search') }}" class="ghost-button">Reset</a>
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Event</th>
                        <th>Penyelenggara</th>
                        <th>Tipe Event</th>
                        <th>Slot Peserta</th>
                        <th>Jadwal Event</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($hasil as $event)
                        <tr>
                            <td>{{ ($hasil->currentPage() - 1) * $hasil->perPage() + $loop->iteration }}</td>
                            <td>{{ $event->nama_event }}</td>
                            <td>{{ $event->penyelenggara }}</td>
                            <td>{{ $event->tipe_event }}</td>
                            <td>{{ number_format($event->slot_peserta, 0, ',', '.') }} peserta</td>
                            <td>
                                {{ $event->tanggal_mulai->format('d-m-Y') }}
                                -
                                {{ $event->tanggal_selesai->format('d-m-Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">Event tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $hasil->links() }}
        </div>
    </div>
@endsection
