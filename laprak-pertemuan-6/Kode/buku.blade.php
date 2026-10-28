
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
</head>

<body>

    <h1>Data Buku</h1>


    <!-- ===================================== -->
    <!-- TABEL 1: 5 BUKU TERBARU -->
    <!-- ===================================== -->

    <h2>5 Buku Terbaru</h2>

    <table border="1" cellpadding="10">

        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Harga</th>
            <th>Tanggal Terbit</th>
        </tr>

        @foreach ($buku_terbaru as $index => $buku)

            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>
                    Rp {{ number_format($buku->harga, 0, ',', '.') }}
                </td>
                <td>{{ $buku->tgl_terbit }}</td>
            </tr>

        @endforeach

    </table>


    <br>
    <hr>
    <br>


    <!-- ===================================== -->
    <!-- TABEL 2: FILTER DAN PENCARIAN -->
    <!-- ===================================== -->

    <h2>Data Seluruh Buku</h2>

    <form action="{{ route('buku.index') }}" method="GET">

        <!-- Dropdown Penulis -->

        <label for="penulis">
            Penulis:
        </label>

        <select name="penulis" id="penulis">

            <option value="Semua Penulis">
                Semua Penulis
            </option>

            @foreach ($penulis as $p)

                <option
                    value="{{ $p->penulis }}"
                    {{ $nama_penulis == $p->penulis ? 'selected' : '' }}
                >
                    {{ $p->penulis }}
                </option>

            @endforeach

        </select>


        <!-- Pencarian Judul -->

        <label for="keyword">
            Cari Judul:
        </label>

        <input
            type="text"
            name="keyword"
            id="keyword"
            value="{{ $keyword }}"
            placeholder="Masukkan judul buku"
        >


        <button type="submit">
            Cari
        </button>

    </form>


    <br>


    <!-- ===================================== -->
    <!-- TABEL DATA HASIL FILTER -->
    <!-- ===================================== -->

    <table border="1" cellpadding="10">

        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Harga</th>
            <th>Tanggal Terbit</th>
        </tr>


        @forelse ($data_buku as $index => $buku)

            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>
                    Rp {{ number_format($buku->harga, 0, ',', '.') }}
                </td>
                <td>{{ $buku->tgl_terbit }}</td>
            </tr>

        @empty

            <tr>
                <td colspan="5">
                    Buku tidak ditemukan.
                </td>
            </tr>

        @endforelse

    </table>


    <br>


    <!-- ===================================== -->
    <!-- STATISTIK -->
    <!-- ===================================== -->

    <h3>Statistik Buku</h3>

    <p>
        Total Buku:
        {{ $total_buku }}
    </p>

    <p>
        Total Harga:
        Rp {{ number_format($total_harga, 0, ',', '.') }}
    </p>

    <p>
        Harga Tertinggi:
        Rp {{ number_format($harga_tertinggi, 0, ',', '.') }}
    </p>

    <p>
        Harga Terendah:
        Rp {{ number_format($harga_terendah, 0, ',', '.') }}
    </p>

</body>
</html>

