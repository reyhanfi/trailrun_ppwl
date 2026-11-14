@extends('auth.layouts')

@section('title', 'Login')

@section('content')
    <div class="card">
        <div class="eyebrow">Akses Admin</div>
        <h1>Login</h1>
        <p>Login untuk mengelola data event Jatrilrun dengan lebih cepat dan teratur.</p>

        <form action="{{ route('authenticate') }}" method="POST" class="auth-form">
            @csrf

            <div class="field-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="email" required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" autocomplete="current-password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button class="primary-button" type="submit" style="width: 100%; margin-top: 8px;">Login</button>
        </form>

        <p class="auth-meta">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
    </div>
@endsection
