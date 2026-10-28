@if ($errors->any())
    <div class="message" style="margin-bottom: 18px;">
        <strong>Periksa kembali isian berikut:</strong>
        <ul style="margin: 10px 0 0 18px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="field-group">
    <label for="nama_event">Nama Event</label>
    <input
        type="text"
        id="nama_event"
        name="nama_event"
        value="{{ old('nama_event', $event?->nama_event) }}"
        placeholder="Contoh: Trail Run Puncak Sejahtera"
    >
</div>

<div class="field-group">
    <label for="penyelenggara">Penyelenggara</label>
    <input
        type="text"
        id="penyelenggara"
        name="penyelenggara"
        value="{{ old('penyelenggara', $event?->penyelenggara) }}"
        placeholder="Contoh: Komunitas Pelari Kota"
    >
</div>

<div class="field-group">
    <label for="tipe_event">Tipe Event</label>
    <select name="tipe_event" id="tipe_event">
        <option value="">Pilih tipe</option>
        @foreach (['Run', 'Trail Run', 'Challenge'] as $tipe)
            <option value="{{ $tipe }}"
                @selected(old('tipe_event', $event?->tipe_event) === $tipe)>
                {{ $tipe }}
            </option>
        @endforeach
    </select>
</div>

<div class="field-group">
    <label for="slot_peserta">Slot Peserta</label>
    <input
        type="number"
        id="slot_peserta"
        name="slot_peserta"
        min="1"
        max="1000000"
        value="{{ old('slot_peserta', $event?->slot_peserta) }}"
        placeholder="150"
    >
</div>

<div class="field-group">
    <label for="tanggal_mulai">Tanggal Mulai</label>
    <input
        type="date"
        id="tanggal_mulai"
        name="tanggal_mulai"
        value="{{ old('tanggal_mulai', $event?->tanggal_mulai?->format('Y-m-d')) }}"
    >
</div>

<div class="field-group">
    <label for="tanggal_selesai">Tanggal Selesai</label>
    <input
        type="date"
        id="tanggal_selesai"
        name="tanggal_selesai"
        value="{{ old('tanggal_selesai', $event?->tanggal_selesai?->format('Y-m-d')) }}"
    >
</div>
