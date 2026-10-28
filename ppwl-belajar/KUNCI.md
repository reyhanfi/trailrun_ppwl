# Kunci latihan PPWL

Gunakan setelah menjawab LATIHAN.md. Potongan kode ditempatkan pada file/method yang disebut soal. Contoh `Buku::...` di controller membutuhkan `use App\Models\Buku;`, dan `Event::...` membutuhkan `use App\Models\Event;`.

## Kunci soal 1–20

| No. | Jawaban |
|---|---|
| 1 | `cd /d "D:\A CURRENT TASK\SEMESTER 3\PPWL\Pertemuan 4\laravel"` |
| 2 | `php -v` |
| 3 | `php latihan.php` |
| 4 | `php -S localhost:8000`, lalu buka `http://localhost:8000/index.php` |
| 5 | `php artisan serve` |
| 6 | `php artisan serve --port=8001` |
| 7 | `composer create-project laravel/laravel quiz-app` |
| 8 | `composer create-project laravel/laravel quiz11 "^11.0"` |
| 9 | `composer install` |
| 10 | `php artisan --version` |
| 11 | `php artisan make:controller PostController` |
| 12 | `php artisan make:model Buku -m` |
| 13 | `php artisan make:migration create_books_table --create=books` |
| 14 | `php artisan migrate` |
| 15 | `php artisan migrate:status` |
| 16 | `php artisan migrate:rollback --step=1` |
| 17 | `php artisan make:seeder EventSeeder` |
| 18 | `php artisan db:seed --class=EventSeeder` |
| 19 | `php artisan db:seed` |
| 20 | `php artisan migrate:fresh --seed` — menghapus semua tabel pada koneksi terkait |

## Kunci soal 21–30

**21.** Di `routes/web.php` (import Route biasanya sudah ada):

```php
Route::get('/about', function () {
    return view('about');
});
```

**22.**

```php
use App\Http\Controllers\PostController;
Route::get('/posts', [PostController::class, 'index']);
```

**23.** `return view('buku', compact('data_buku'));`

**24.** `resources/views/buku/index.blade.php`.

**25.** `{{ $name }}`.

**26.**

```blade
@foreach ($data_buku as $buku)
    <p>{{ $buku->judul }}</p>
@endforeach
```

**27.**

```blade
@forelse ($data_buku as $buku)
    <p>{{ $buku->judul }}</p>
@empty
    <p>Buku tidak ditemukan.</p>
@endforelse
```

**28.** `@yield('content')`.

**29.**

```blade
@extends('layouts.app')
@section('content')
    <h1>About</h1>
@endsection
```

**30.** `<link rel="stylesheet" href="{{ asset('css/style.css') }}">`.

## Kunci soal 31–45

**31.** `protected $table = 'books';`

**32.** `public $timestamps = false;`

**33.** `$table->date('tgl_terbit');`

**34.**

```php
$this->call([BukuSeeder::class, EventSeeder::class]);
```

**35.** `$buku_terbaru = Buku::orderBy('id', 'desc')->take(5)->get();`

**36.** `$data_buku = Buku::where('penulis', 'Budi Santoso')->get();`

**37.** `$penulis = Buku::select('penulis')->distinct()->get();`

**38.**

```php
$total_buku = $data_buku->count();
$total_harga = $data_buku->sum('harga');
```

**39.** `$event_terbaru = Event::orderBy('tanggal_mulai', 'desc')->take(5)->get();`

**40.** `$total_trail_run = Event::where('tipe_event', 'Trail Run')->count();`

**41.** `$keyword = $request->keyword;` atau `$keyword = $request->input('keyword');`.

**42.**

```php
$data_buku = $data_buku->filter(function ($buku) use ($keyword) {
    return stripos($buku->judul, $keyword) !== false;
});
```

**43.** `UPDATE buku SET harga = 120000 WHERE id = 3;`

**44.** `echo htmlspecialchars($buku['judul'], ENT_QUOTES, 'UTF-8');`

**45.** Pindah ke root proyek yang berisi `artisan`; di CMD cek dengan `dir`. Command benar tetapi direktori kerjanya salah.

## Studi kasus Buku

**B1.** `php artisan make:controller BukuController`.

**B2.** Di `routes/web.php`:

```php
use App\Http\Controllers\BukuController;
Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
```

**B3.** Pada BukuController dengan import Buku:

```php
public function index()
{
    $data_buku = Buku::all();
    return view('buku', compact('data_buku'));
}
```

**B4.** Import berada di bagian atas file; panggilan `create` berada dalam `run()`:

```php
use App\Models\Buku;

// Dalam run():
Buku::create([
    'judul' => 'Belajar Laravel',
    'penulis' => 'Budi Santoso',
    'harga' => 75000,
    'tgl_terbit' => '2026-09-01',
]);
```

**B5.**

```blade
<form action="{{ route('buku.index') }}" method="GET">
    <input type="text" name="keyword" value="{{ $keyword }}">
    <button type="submit">Cari</button>
</form>
```

**B6.** Dengan import Buku dan Request di controller:

```php
$nama_penulis = $request->penulis;
$data_buku = Buku::all();
if ($nama_penulis && $nama_penulis != 'Semua Penulis') {
    $data_buku = Buku::where('penulis', $nama_penulis)->get();
}
```

**B7.** `Rp {{ number_format($buku->harga, 0, ',', '.') }}`.

**B8.**

```php
$total_buku = $data_buku->count();
$total_harga = $data_buku->sum('harga');
```

Jika Collection kosong: jumlah 0, total harga 0. `Buku::count()` menghitung seluruh tabel sehingga tidak memenuhi permintaan statistik hasil filter ini.

## Studi kasus Trail Run

**E1.** `php artisan make:seeder EventSeeder`.

**E2.** `php artisan db:seed --class=EventSeeder`.

**E3.** `$events = Event::where('tipe_event', 'Challenge')->get();`

**E4.** `$event_terbaru = Event::orderBy('tanggal_mulai', 'desc')->take(5)->get();`

**E5.**

```php
if ($keyword) {
    $events = $events->filter(function ($event) use ($keyword) {
        return stripos($event->nama_event, $keyword) !== false;
    });
}
```

**E6.**

```php
$total_event = Event::count();
$total_run = Event::where('tipe_event', 'Run')->count();
```

**E7.** `{{ date('d-m-Y', strtotime($event->tanggal_mulai)) }}`.

**E8.** Daftar diambil dari `$events` yang sudah difilter, tetapi statistik menggunakan `Event::count()` terhadap seluruh tabel. Angka 20 berlaku jika database masih berisi 20 event seperti kondisi laporan.

## Studi kasus perbaikan

**D1.** Tambahkan `$this->call(BukuSeeder::class);` pada method `run()` DatabaseSeeder. Alternatif eksekusi langsung adalah `php artisan db:seed --class=BukuSeeder`, tetapi kartu ini meminta perbaikan kode agar ikut `db:seed`.

**D2.** Ubah nama file menjadi `resources/views/buku.blade.php`, atau ubah pemanggilan menjadi `view('books')`. Pilih salah satu sesuai nama yang ingin dipakai.

**D3.** `return view('buku', compact('data_buku'));`

**D4.** `protected $table = 'books';`

**D5.** `if (stripos($judul, $keyword) !== false)` — nilai posisi 0 tetap dihitung sebagai ditemukan.

**D6.** `php artisan config:clear`.

**D7.** `php artisan migrate`.

**D8.** `DELETE FROM buku WHERE id = 7;`.

## Lima pasangan yang wajib dibedakan

1. `make:seeder` membuat file; `db:seed` menjalankan pengisian data.
2. `make:migration` membuat file; `migrate` menerapkan perubahan struktur.
3. `php file.php` menghasilkan output terminal; `php -S ...` melayani HTTP; `php artisan serve` menjalankan server development Laravel.
4. `view('buku')` memilih template; `compact('data_buku')` mengirim data.
5. `$data_buku->count()` menghitung Collection itu; `Buku::count()` menghitung baris pada tabel melalui model.
