<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    public function run(): void
    {

        $data = [
            [
                'judul' => 'Pemrograman Web Dasar',
                'penulis' => 'Budi Santoso',
                'harga' => 50000,
                'tgl_terbit' => '2026-01-10'
            ],
            [
                'judul' => 'Belajar Laravel untuk Pemula',
                'penulis' => 'Andi Pratama',
                'harga' => 65000,
                'tgl_terbit' => '2026-01-15'
            ],
            [
                'judul' => 'Dasar-Dasar PHP',
                'penulis' => 'Citra Lestari',
                'harga' => 45000,
                'tgl_terbit' => '2026-01-20'
            ],
            [
                'judul' => 'Algoritma Pemrograman',
                'penulis' => 'Dian Saputra',
                'harga' => 55000,
                'tgl_terbit' => '2026-02-01'
            ],
            [
                'judul' => 'Database MySQL Dasar',
                'penulis' => 'Eko Wijaya',
                'harga' => 60000,
                'tgl_terbit' => '2026-02-05'
            ],
            [
                'judul' => 'Pemrograman Web Lanjutan',
                'penulis' => 'Budi Santoso',
                'harga' => 70000,
                'tgl_terbit' => '2026-02-10'
            ],
            [
                'judul' => 'Laravel dan MVC',
                'penulis' => 'Andi Pratama',
                'harga' => 75000,
                'tgl_terbit' => '2026-02-15'
            ],
            [
                'judul' => 'Pemrograman Berorientasi Objek',
                'penulis' => 'Citra Lestari',
                'harga' => 80000,
                'tgl_terbit' => '2026-02-20'
            ],
            [
                'judul' => 'Struktur Data Dasar',
                'penulis' => 'Dian Saputra',
                'harga' => 50000,
                'tgl_terbit' => '2026-03-01'
            ],
            [
                'judul' => 'Pengembangan Aplikasi Web',
                'penulis' => 'Eko Wijaya',
                'harga' => 85000,
                'tgl_terbit' => '2026-03-05'
            ],
            [
                'judul' => 'HTML dan CSS untuk Pemula',
                'penulis' => 'Budi Santoso',
                'harga' => 40000,
                'tgl_terbit' => '2026-03-10'
            ],
            [
                'judul' => 'Routing pada Laravel',
                'penulis' => 'Andi Pratama',
                'harga' => 55000,
                'tgl_terbit' => '2026-03-15'
            ],
            [
                'judul' => 'Membangun Website Modern',
                'penulis' => 'Citra Lestari',
                'harga' => 90000,
                'tgl_terbit' => '2026-03-20'
            ],
            [
                'judul' => 'Konsep REST API',
                'penulis' => 'Dian Saputra',
                'harga' => 70000,
                'tgl_terbit' => '2026-04-01'
            ],
            [
                'judul' => 'Manajemen Database',
                'penulis' => 'Eko Wijaya',
                'harga' => 65000,
                'tgl_terbit' => '2026-04-05'
            ],
            [
                'judul' => 'Framework Laravel',
                'penulis' => 'Budi Santoso',
                'harga' => 95000,
                'tgl_terbit' => '2026-04-10'
            ],
            [
                'judul' => 'Membuat CRUD dengan Laravel',
                'penulis' => 'Andi Pratama',
                'harga' => 85000,
                'tgl_terbit' => '2026-04-15'
            ],
            [
                'judul' => 'Pemrograman Backend',
                'penulis' => 'Citra Lestari',
                'harga' => 75000,
                'tgl_terbit' => '2026-04-20'
            ],
            [
                'judul' => 'Eloquent ORM Laravel',
                'penulis' => 'Dian Saputra',
                'harga' => 90000,
                'tgl_terbit' => '2026-05-01'
            ],
            [
                'judul' => 'Membuat Website dengan Laravel',
                'penulis' => 'Eko Wijaya',
                'harga' => 100000,
                'tgl_terbit' => '2026-05-05'
            ],
        ];

        foreach ($data as $buku) {
            Buku::create($buku);
        }
    }
}