@extends('auth.layouts')

@section('title', 'Edit User')

@section('content')
    <section class="page-header">
        <div>
            <p class="eyebrow">Manajemen User</p>
            <h1>Edit User: {{ $user->name }}</h1>
        </div>
        <div class="header-actions">
            <a href="{{ route('users.index') }}" class="ghost-button">&larr; Kembali ke Daftar User</a>
        </div>
    </section>

    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="field-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field-group">
                <label for="level">Level Akses</label>
                <select id="level" name="level" required style="width: 100%; padding: 12px 14px; border-radius: 10px; border: 1px solid var(--line); font-size: 0.95rem;">
                    <option value="user" {{ old('level', $user->level) === 'user' ? 'selected' : '' }}>User (Pengguna Biasa)</option>
                    <option value="admin" {{ old('level', $user->level) === 'admin' ? 'selected' : '' }}>Admin (Pengelola Sistem)</option>
                </select>
                @error('level')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field-group">
                <label for="password">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" id="password" name="password">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field-group">
                <label for="password_confirmation">Konfirmasi Password Baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>

            <div style="display: flex; gap: 12px; margin-top: 24px;">
                <button type="submit" class="primary-button" style="flex: 1;">Perbarui User</button>
                <a href="{{ route('users.index') }}" class="ghost-button">Batal</a>
            </div>
        </form>
    </div>
@endsection
