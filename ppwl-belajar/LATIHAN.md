# Latihan acak satu langkah + studi kasus PPWL

## Cara latihan

Pilih angka 1–45 secara acak. Baca hanya satu soal, jawab dengan command atau potongan kode, lalu cek nomor yang sama di KUNCI.md. Target 30–60 detik. Latihan command database yang mengubah data gunakan database latihan sendiri. Tidak perlu membuat seluruh aplikasi jika soal hanya meminta satu langkah.

Untuk soal Artisan, anggap terminal sudah berada di root proyek dan PHP tersedia, kecuali soal menyebut lain. Untuk soal query, model dan tabel sudah tersedia. Import yang diperlukan tetap menjadi bagian jawaban jika belum ada.

## A. CMD, PHP, dan Composer

1. CMD sedang berada di drive C. Pindah ke folder `D:\A CURRENT TASK\SEMESTER 3\PPWL\Pertemuan 4\laravel` dalam satu command.
2. Tampilkan versi PHP yang sedang dipakai terminal.
3. Jalankan file `latihan.php` agar hasilnya tampil di terminal.
4. Kamu berada di folder berisi `index.php` native. Nyalakan server di localhost port 8000 agar file dapat dibuka di browser.
5. Kamu berada di root Laravel. Jalankan development server.
6. Port 8000 dipakai. Jalankan Laravel di port 8001.
7. Buat proyek Laravel baru bernama `quiz-app` melalui Composer.
8. Buat proyek `quiz11` dengan constraint Laravel 11 melalui Composer.
9. Proyek sudah diunduh, `composer.lock` tersedia, folder vendor belum ada. Pasang dependensinya.
10. Tampilkan versi Laravel proyek aktif.

## B. Membuat file vs menjalankan proses

11. Buat controller bernama `PostController`.
12. Buat model bernama `Buku` sekaligus migration-nya.
13. Buat migration untuk membuat tabel `books` dengan opsi nama tabel eksplisit.
14. Jalankan semua migration yang belum diterapkan.
15. Lihat status migration.
16. Batalkan satu migration terakhir.
17. Buat file seeder bernama `EventSeeder`.
18. Jalankan hanya `EventSeeder` tanpa melalui DatabaseSeeder.
19. Jalankan DatabaseSeeder.
20. Penguji secara eksplisit meminta seluruh tabel database latihan dibuang, dibangun ulang, lalu diisi lewat DatabaseSeeder. Tulis command.

## C. Route, controller, dan Blade

21. Pada `routes/web.php`, buat route GET `/about` yang menampilkan view `about`.
22. Hubungkan GET `/posts` ke method `index` dari `PostController`; tulis import controller-nya juga.
23. Di controller, variabel `$data_buku` sudah tersedia. Kembalikan view `buku` sambil mengirim variabel itu.
24. Tulis lokasi file yang dicari oleh `view('buku.index')`.
25. Pada Blade, tampilkan `$name` dengan escaping HTML.
26. Tampilkan semua judul dari `$data_buku` memakai `@foreach`.
27. Tampilkan judul, tetapi jika `$data_buku` kosong tampilkan “Buku tidak ditemukan.”
28. Di layout induk, sediakan tempat untuk section `content`.
29. Di halaman anak, gunakan layout `layouts.app` dan isi section `content` dengan `<h1>About</h1>`.
30. Hubungkan file `public/css/style.css` dari Blade menggunakan helper aset.

## D. Model, migration, seeder, dan query

31. Di model Buku, tentukan secara eksplisit bahwa tabelnya bernama `books`.
32. Di model, nonaktifkan pengisian timestamp otomatis.
33. Di dalam `Schema::create`, buat kolom `tgl_terbit` bertipe tanggal.
34. Pada method `run()` DatabaseSeeder, panggil BukuSeeder dan EventSeeder.
35. Di controller, ambil lima Buku dengan id terbesar terlebih dahulu.
36. Ambil Buku yang penulisnya `Budi Santoso`.
37. Ambil daftar penulis unik melalui model Buku.
38. `$data_buku` adalah Collection hasil filter. Hitung jumlah buku dan total harganya.
39. Ambil lima Event dengan `tanggal_mulai` paling besar terlebih dahulu.
40. Hitung jumlah semua Event bertipe `Trail Run` langsung di database.

## E. Search, PHP native, dan diagnosis

41. Di controller yang menerima `Request $request`, ambil parameter query string `keyword` ke `$keyword`.
42. `$data_buku` adalah Collection dan `$keyword` sudah tersedia. Filter judul dengan `stripos` tanpa membedakan huruf besar/kecil.
43. Native PHP: tulis SQL untuk mengubah harga buku id 3 menjadi 120000.
44. Native PHP: `$buku` berasal dari `mysqli_fetch_assoc()`. Tampilkan judulnya dengan escaping HTML.
45. `php artisan serve` menghasilkan `Could not open input file: artisan`. Apa yang diperbaiki terlebih dahulu?

## Studi kasus 1 — Toko Buku: pilih satu kartu

Konteks: model `App\Models\Buku` memakai tabel `books`, atribut `judul`, `penulis`, `harga`, `tgl_terbit`. Controller `BukuController`, view `buku.blade.php`. Masing-masing kartu adalah soal terpisah; tidak perlu mengerjakan seluruh alur untuk menjawab satu kartu.

**B1.** Buat controller BukuController lewat terminal.

**B2.** Buat route `/buku` menuju `index` dan beri nama `buku.index`.

**B3.** Tulis method `index()` yang mengambil semua Buku lalu mengirimnya sebagai `$data_buku` ke view `buku`.

**B4.** Pada method `run()` BukuSeeder, tambahkan satu buku: judul “Belajar Laravel”, penulis “Budi Santoso”, harga 75000, tanggal terbit 2026-09-01. Tulis import model yang diperlukan.

**B5.** Tulis form GET menuju route `buku.index` dengan input bernama `keyword`; pertahankan nilai `$keyword` setelah submit.

**B6.** Dalam method `index(Request $request)`, tulis logika filter penulis dari request. Nilai `Semua Penulis` berarti jangan filter.

**B7.** Pada daftar harga, tampilkan `75000` sebagai `Rp 75.000` menggunakan nilai `$buku->harga`.

**B8.** Pencarian tidak menghasilkan buku. Statistik diminta mengikuti hasil yang ditampilkan. Tulis jumlah dan total harga berdasarkan `$data_buku`, lalu sebutkan hasilnya jika kosong.

## Studi kasus 2 — Trail Run: pilih satu kartu

Konteks: `App\Models\Event`, tabel `events`, atribut `nama_event`, `penyelenggara`, `tipe_event`, `tanggal_mulai`, `tanggal_selesai`. Tipe: `Run`, `Trail Run`, `Challenge`.

**E1.** Buat seeder EventSeeder lewat terminal.

**E2.** Jalankan hanya EventSeeder.

**E3.** Ambil semua event tipe Challenge sebagai `$events`.

**E4.** Ambil lima event terbaru berdasarkan `tanggal_mulai`.

**E5.** `$events` sudah difilter tipe. Terapkan pencarian nama menggunakan `$keyword` dengan pola Collection dari laporan.

**E6.** Tulis query jumlah semua event dan jumlah event Run. Statistik harus tetap menghitung seluruh database walaupun daftar difilter.

**E7.** Di Blade, tampilkan tanggal mulai sebagai `27-09-2026` jika nilainya `2026-09-27`.

**E8.** Mengapa pencarian tanpa hasil bisa menampilkan tabel kosong tetapi statistik Event tetap 20? Jelaskan sesuai kode laporan.

## Studi kasus 3 — Penguji menyuruh memperbaiki satu bagian

**D1.** BukuSeeder sudah dibuat, tetapi `php artisan db:seed` hanya menjalankan seeder bawaan. Berikan satu perbaikan kode agar BukuSeeder ikut berjalan.

**D2.** Route `/buku` sudah benar, tetapi muncul `View [buku] not found`. File view yang dibuat ternyata `resources/views/books.blade.php`. Berikan salah satu perbaikan.

**D3.** View memakai `$data_buku`, tetapi controller hanya menulis `return view('buku');`. Perbaiki satu baris itu; anggap `$data_buku` sudah berisi Collection.

**D4.** Model Buku mencoba tabel yang namanya tidak sesuai. Tabel asli adalah `books`. Tulis satu properti model untuk memperbaikinya.

**D5.** Kode pencarian memakai `if (stripos($judul, $keyword))`. Pencarian gagal jika kata ditemukan di awal judul. Perbaiki kondisi.

**D6.** `.env` sudah diganti tetapi konfigurasi database masih memakai nilai lama karena cache. Tulis command yang sesuai.

**D7.** Migration baru selesai dibuat, tetapi tabel belum ada. Tulis command yang masih perlu dijalankan.

**D8.** Penguji menunjukkan `DELETE FROM buku;` untuk menghapus hanya id 7. Perbaiki SQL.

## Penilaian mandiri

- **2 poin:** command/kode tepat, lokasi tepat, dapat menjelaskan fungsinya.
- **1 poin:** konsep benar tetapi ada salah nama, import, atau tanda baca.
- **0 poin:** tertukar fungsi command atau tidak dapat menjawab.

Catat soal yang nilainya 0–1, lalu ulang hanya soal tersebut setelah 15 menit. Kemampuan mengetik dari ingatan lebih relevan untuk live coding dibanding hanya merasa familier saat membaca.
