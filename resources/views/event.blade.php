@extends('auth.layouts')

@section('title', 'Data Event Trail Run')

@section('content')
    <section class="page-header">
        <div>
            <p class="eyebrow">Manajemen Event</p>
            <h1>Data Event Trail Run</h1>
        </div>
        <div class="header-actions">
            <a href="{{ route('event.create') }}" class="primary-button">Tambah Event</a>
            <a href="{{ route('event.search') }}" class="ghost-button">Pencarian Khusus</a>
        </div>
    </section>

    @if (session('pesan'))
        <div class="flash-message">{{ session('pesan') }}</div>
    @endif

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Event</div>
            <div class="stat-value">{{ $total_event }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Run</div>
            <div class="stat-value">{{ $total_run }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Trail Run</div>
            <div class="stat-value">{{ $total_trail_run }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Challenge</div>
            <div class="stat-value">{{ $total_challenge }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Slot</div>
            <div class="stat-value">{{ number_format($total_slot_peserta, 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="panel">
        <div class="toolbar">
            <div>
                <div class="eyebrow">Data Seluruh Event</div>
            </div>
        </div>

        <form action="{{ route('event.index') }}" method="GET" class="filter-form">
            <div class="field-group">
                <label for="tipe_event">Tipe Event</label>
                <select name="tipe_event" id="tipe_event">
                    <option value="Semua Tipe"
                        @selected($tipe_event === 'Semua Tipe' || !$tipe_event)>
                        Semua Tipe
                    </option>
                    <option value="Run" @selected($tipe_event === 'Run')>Run</option>
                    <option value="Trail Run" @selected($tipe_event === 'Trail Run')>Trail Run</option>
                    <option value="Challenge" @selected($tipe_event === 'Challenge')>Challenge</option>
                </select>
            </div>

            <div class="field-group">
                <label for="keyword">Cari Nama Event</label>
                <input
                    type="text"
                    name="keyword"
                    id="keyword"
                    value="{{ $keyword }}"
                    placeholder="Masukkan nama event"
                >
            </div>

            <button type="submit" class="secondary-button">Cari</button>
            <a href="{{ route('event.index') }}" class="ghost-button">Reset</a>
        </form>
    </div>

    <div class="panel" style="margin-top: 22px;">
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr>
                            <td>{{ ($events->currentPage() - 1) * $events->perPage() + $loop->iteration }}</td>
                            <td>{{ $event->nama_event }}</td>
                            <td>{{ $event->penyelenggara }}</td>
                            <td>{{ $event->tipe_event }}</td>
                            <td>{{ number_format($event->slot_peserta, 0, ',', '.') }} peserta</td>
                            <td>
                                {{ $event->tanggal_mulai->format('d-m-Y') }}
                                -
                                {{ $event->tanggal_selesai->format('d-m-Y') }}
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('event.edit', $event->id) }}" class="mini-button edit">Edit</a>
                                    <form action="{{ route('event.destroy', $event->id) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="mini-button delete"
                                            onclick="return confirm('Yakin ingin menghapus event ini?')"
                                        >Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty-state">Event tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $events->links() }}
        </div>
    </div>
@endsection
