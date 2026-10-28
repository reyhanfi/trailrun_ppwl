# Panduan Praktikum Presensi - Pertemuan 5

Latihan pada halaman terakhir modul meminta aplikasi Presensi dengan Spinner, DatePicker, TimePicker, dan custom dialog keluar. Laporan Hafidz digunakan sebagai contoh susunan pembahasan. Hasil pekerjaan ini memiliki empat bab: Tujuan Praktikum, Hasil dan Pembahasan, Kesimpulan, dan Video.

## Membuka hasil yang sudah selesai

1. Buka Android Studio, pilih **Open**, lalu pilih folder **PresensiApp** di dalam folder Pertemuan 5 - Spinner.
2. Tunggu Gradle Sync selesai. Gunakan Gradle JDK bawaan Android Studio (JBR).
3. Pilih emulator **Pixel 8 Pro**, lalu tekan tombol **Run app**.
4. APK siap dipasang secara manual tersedia di folder **APK**.

## Langkah membuat ulang dari project baru

1. Pilih **New Project > Empty Views Activity**. Isi nama `PresensiApp`, package `com.example.presensiapp`, Kotlin, dan minimum SDK **API 24**, kemudian Finish.
2. Buka `app/build.gradle.kts`. Tambahkan `buildFeatures { viewBinding = true }` di dalam `android`, kemudian klik **Sync Now**. Project hasil memakai compile SDK dan target SDK 37 sesuai SDK yang sudah terpasang.
3. Buka `app/src/main/res/layout/activity_main.xml`. Susun ScrollView dan LinearLayout vertikal berisi DatePicker kalender, TimePicker spinner, Spinner status, EditText keterangan, tombol Submit dan Keluar, serta TextView hasil. Kode lengkap tersedia di project dan laporan.
4. Isi `res/values/strings.xml` dengan label dan string-array empat status: Hadir Tepat Waktu, Sakit, Terlambat, dan Izin.
5. Pada `MainActivity.kt`, inflate `ActivityMainBinding`, pasang ArrayAdapter pada Spinner, dan buat OnItemSelectedListener. Sembunyikan keterangan untuk posisi nol; tampilkan pada posisi lainnya.
6. Buat fungsi Submit. Rapikan keterangan dengan trim, tolak status selain Hadir jika keterangan kosong, lalu baca tanggal dan waktu. Tambahkan satu pada nilai bulan. Tampilkan Toast dan ringkasan hasil pada TextView.
7. Buat `res/layout/dialog_exit.xml` berisi pertanyaan dan tombol Tidak/Ya. Buat `DialogExit.kt` sebagai DialogFragment; Tidak memanggil dismiss, Ya memanggil finish. Tampilkan dialog dari tombol Keluar dan tombol Back.
8. Gunakan warna serta tema di `res/values/colors.xml` dan `themes.xml`. Semua file source sudah disertakan sehingga dapat dipakai untuk menyusun ulang aplikasi dengan tampilan yang sama.
9. Jalankan melalui Run app. Pilih tanggal dan waktu lain, buka Spinner, dan periksa keterangan pada masing-masing status.
10. Pilih Sakit dengan keterangan kosong lalu Submit. Pesan **Isi keterangan terlebih dahulu** harus muncul. Isi keterangan dan Submit lagi; tanggal, waktu, status, dan keterangan harus sesuai.
11. Pilih Hadir Tepat Waktu. Kolom keterangan harus hilang dan Submit berhasil tanpa keterangan. Tekan Keluar; coba Tidak, kemudian Keluar lagi dan pilih Ya.

## Screenshot untuk laporan

Semua screenshot sudah diambil dari aplikasi yang berjalan di emulator dan ada di folder **Screenshot**:

| File | Bukti |
|---|---|
| 01-tampilan-awal.png | Tampilan awal, tanggal, waktu, status Hadir, Submit dan Keluar |
| 02-pilihan-status.png | Empat pilihan Spinner |
| 03-keterangan-sakit.png | Keterangan muncul saat status Sakit |
| 04-validasi-keterangan.png | Pesan validasi keterangan kosong |
| 05-presensi-berhasil.png | Hasil Submit status Sakit dengan keterangan |
| 06-dialog-keluar.png | Custom dialog dengan tombol Tidak dan Ya |
| 07-hadir-tanpa-keterangan.png | Hasil Submit status Hadir tanpa keterangan |

## Laporan dan video

- **Laporan Latex/main.tex** adalah sumber laporan yang dapat diedit. Folder kode berisi salinan kode project yang dimasukkan langsung melalui listings, dan folder gambar memuat bukti aplikasi.
- **Laporan Latex/main.pdf** adalah hasil laporan untuk dibaca atau dikumpulkan.
- **Video/demo-presensi.mp4** adalah demonstrasi yang diringkas dari rekaman emulator tanpa suara. Rekaman asli turut disertakan.
- Nama, NIM, kelas, dan dosen diambil dari template LaTeX yang dilampirkan. Nomor pertemuan mengikuti nama folder (5), sedangkan contoh Hafidz tertulis Pertemuan 6.
- Presensi ditampilkan di layar; aplikasi ini belum memakai database atau server.

Referensi panduan Android: https://developer.android.com/studio/projects/create-project, https://developer.android.com/topic/libraries/view-binding, https://developer.android.com/develop/ui/views/components/spinner, dan https://developer.android.com/develop/ui/views/components/dialogs.
