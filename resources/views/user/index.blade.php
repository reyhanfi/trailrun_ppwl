@extends('auth.layouts')

@section('title', 'Manajemen User')

@section('content')
    <section class="page-header">
        <div>
            <p class="eyebrow">Akses Khusus Admin</p>
            <h1>Manajemen User</h1>
        </div>
        <div class="header-actions">
            <a href="{{ route('users.create') }}" class="primary-button">+ Tambah User</a>
        </div>
    </section>

    @if (session('status'))
        <div class="message">{{ session('status') }}</div>
    @endif

    <div class="panel">
        <div class="toolbar">
            <div>
                <div class="eyebrow">Daftar Pengguna Sistem</div>
                <p style="margin: 4px 0 0; color: var(--muted); font-size: 0.95rem;">
                    Halaman ini diproteksi oleh middleware <code>admin</code>. Hanya akun dengan level admin yang dapat melihat dan mengelola data pengguna.
                </p>
            </div>
        </div>

        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat Email</th>
                        <th>Level Akses</th>
                        <th>Terdaftar Pada</th>
                        <th style="width: 140px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $index }}</td>
                            <td style="font-weight: 700;">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->level === 'admin')
                                    <span style="display: inline-block; padding: 4px 10px; border-radius: 999px; background: #dcfce7; color: #166534; font-weight: 700; font-size: 0.85rem;">
                                        Admin
                                    </span>
                                @else
                                    <span style="display: inline-block; padding: 4px 10px; border-radius: 999px; background: #e0f2fe; color: #0369a1; font-weight: 700; font-size: 0.85rem;">
                                        User
                                    </span>
                                @endif
                            </td>
                            <td>{{ $user->created_at ? $user->created_at->format('d M Y, H:i') : '-' }}</td>
                            <td style="text-align: center;">
                                <div style="display: inline-flex; gap: 6px;">
                                    <a href="{{ route('users.edit', $user) }}" class="mini-button edit">Edit</a>
                                    @if (auth()->id() !== $user->id)
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="mini-button delete">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">Belum ada data user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <div class="pagination">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
