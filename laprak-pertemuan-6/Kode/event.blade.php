<!DOCTYPE html>
<html>
<head>
    <title>Data Event Trail Run</title>
</head>

<body>

    <h1>Data Event Trail Run</h1>

    <h2>5 Event Terbaru</h2>

    <table border="1" cellpadding="8" cellspacing="0">

        <tr>
            <th>No</th>
            <th>Nama Event</th>
            <th>Penyelenggara</th>
            <th>Tipe Event</th>
            <th>Jadwal Event</th>
        </tr>

        @foreach ($event_terbaru as $event)

        <tr>
            <td>{{ $loop->iteration }}</td>

            <td>{{ $event->nama_event }}</td>

            <td>{{ $event->penyelenggara }}</td>

            <td>{{ $event->tipe_event }}</td>

            <td>
                {{ date('d-m-Y', strtotime($event->tanggal_mulai)) }}
                -
                {{ date('d-m-Y', strtotime($event->tanggal_selesai)) }}
            </td>
        </tr>

        @endforeach

    </table>

    <br>

    <hr>

    <br>

    <h2>Data Seluruh Event</h2>

    <form action="/event" method="GET">

        <label for="tipe_event">Tipe Event:</label>

        <select name="tipe_event" id="tipe_event">

            <option value="Semua Tipe">
                Semua Tipe
            </option>

            <option value="Run"
                {{ $tipe_event == 'Run' ? 'selected' : '' }}>
                Run
            </option>

            <option value="Trail Run"
                {{ $tipe_event == 'Trail Run' ? 'selected' : '' }}>
                Trail Run
            </option>

            <option value="Challenge"
                {{ $tipe_event == 'Challenge' ? 'selected' : '' }}>
                Challenge
            </option>

        </select>

        <label for="keyword">Cari Event:</label>

        <input
            type="text"
            name="keyword"
            id="keyword"
            value="{{ $keyword }}"
            placeholder="Masukkan nama event"
        >

        <button type="submit">
            Cari
        </button>

    </form>

    <br>

    <table border="1" cellpadding="8" cellspacing="0">

        <tr>
            <th>No</th>
            <th>Nama Event</th>
            <th>Penyelenggara</th>
            <th>Tipe Event</th>
            <th>Jadwal Event</th>
        </tr>

        @forelse ($events as $event)

        <tr>
            <td>{{ $loop->iteration }}</td>

            <td>{{ $event->nama_event }}</td>

            <td>{{ $event->penyelenggara }}</td>

            <td>{{ $event->tipe_event }}</td>

            <td>
                {{ date('d-m-Y', strtotime($event->tanggal_mulai)) }}
                -
                {{ date('d-m-Y', strtotime($event->tanggal_selesai)) }}
            </td>
        </tr>

        @empty

        <tr>
            <td colspan="5">
                Event tidak ditemukan.
            </td>
        </tr>

        @endforelse

    </table>

    <br>

    <h2>Statistik Event</h2>

    <p>Total Event: {{ $total_event }}</p>

    <p>Total Run: {{ $total_run }}</p>

    <p>Total Trail Run: {{ $total_trail_run }}</p>

    <p>Total Challenge: {{ $total_challenge }}</p>

</body>
</html>