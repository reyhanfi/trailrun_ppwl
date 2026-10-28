@extends('auth.layouts')

@section('title', 'Dashboard Event Trail Run')

@section('content')
    <section class="page-header">
        <div>
            <p class="eyebrow">Overview</p>
            <h1>Dashboard</h1>
            <p>Selamat datang, <strong>{{ auth()->user()->name }}</strong>. Kelola event trail run Anda dengan lebih rapi dan terstruktur.</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('event.index') }}" class="primary-button">Lihat Data Event</a>
        </div>
    </section>

    <div class="panel" style="padding: 28px;">
        <div class="eyebrow">Ringkasan</div>
        <p class="section-note">Kamu sudah login dan siap untuk mengelola acara trail run, memantau jadwal, serta mengatur peserta dengan lebih efektif.</p>
    </div>
@endsection
