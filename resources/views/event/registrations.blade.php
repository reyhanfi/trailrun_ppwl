@extends('auth.layouts')

@section('title', 'Daftar Peserta')

@section('content')
    <section class="page-header">
        <div>
            <p class="eyebrow">Daftar Peserta</p>
            <h1>{{ $event->nama_event }}</h1>
        </div>
        <div class="header-actions">
            <a class="primary-button" href="{{ route('event.registrations.export', $event) }}">Export Excel</a>
            <a class="ghost-button" href="{{ route('event.index') }}">Kembali ke Daftar</a>
        </div>
    </section>

    @error('status')
        <p class="error" role="alert">{{ $message }}</p>
    @enderror

    <div class="panel">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                        <th>Foto KTP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($registrations as $registration)
                        <tr>
                            <td>{{ $registration->user->name }}</td>
                            <td>{{ $registration->user->email }}</td>
                            <td>{{ $registration->created_at->format('d-m-Y H:i') }}</td>
                            <td><span class="role-badge">{{ $registration->status }}</span></td>
                            <td><a class="mini-button edit" href="{{ route('registrations.ktp', $registration) }}">Unduh Foto KTP</a></td>
                            <td>
                                <form class="table-actions" action="{{ route('registrations.update', $registration) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="mini-button edit" type="submit" name="status" value="Accepted">Terima</button>
                                    <button class="mini-button delete" type="submit" name="status" value="Rejected">Tolak</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="empty-state" colspan="6">Belum ada peserta yang mendaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $registrations->onEachSide(1)->links('pagination') }}
    </div>
@endsection
