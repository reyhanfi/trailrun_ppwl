<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        // 5 buku terbaru
        $buku_terbaru = Buku::orderBy('id', 'desc')
            ->take(5)
            ->get();

        // Mengambil penulis yang dipilih
        $nama_penulis = $request->penulis;

        // Mengambil keyword pencarian
        $keyword = $request->keyword;

        // Menampilkan semua buku
        $data_buku = Buku::all();

        // Filter berdasarkan penulis
        if ($nama_penulis && $nama_penulis != 'Semua Penulis') {
            $data_buku = Buku::where('penulis', $nama_penulis)->get();
        }

        // Filter berdasarkan judul
        if ($keyword) {
            $data_buku = $data_buku->filter(function ($buku) use ($keyword) {
                return stripos($buku->judul, $keyword) !== false;
            });
        }

        // Mengambil daftar penulis
        $penulis = Buku::select('penulis')
            ->distinct()
            ->get();

        // Statistik
        $total_buku = $data_buku->count();
        $total_harga = $data_buku->sum('harga');
        $harga_tertinggi = $data_buku->max('harga');
        $harga_terendah = $data_buku->min('harga');

        return view('buku', compact(
            'buku_terbaru',
            'data_buku',
            'penulis',
            'nama_penulis',
            'keyword',
            'total_buku',
            'total_harga',
            'harga_tertinggi',
            'harga_terendah'
        ));
    }
}