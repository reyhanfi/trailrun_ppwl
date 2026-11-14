@extends('auth.layouts')

@section('title', 'Daftar')

@section('content')
    <div class="card">
        <div class="eyebrow">Buat Akun Baru</div>
        <h1>Daftar Akun</h1>
        <p>Buat akun untuk mengelola data event Jatrilrun dengan tampilan yang rapi dan terstruktur.</p>

        <form action="{{ route('store') }}" method="POST" class="auth-form">
            @csrf

            <div class="field-group">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" autocomplete="name" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="email" required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" autocomplete="new-password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" required>
            </div>

            <button class="primary-button" type="submit" style="width: 100%; margin-top: 8px;">Daftar</button>
        </form>

        <p class="auth-meta">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
    </div>
@endsection
