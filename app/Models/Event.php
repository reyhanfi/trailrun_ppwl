<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    public $timestamps = false;

    protected $fillable = [
        'nama_event',
        'penyelenggara',
        'tipe_event',
        'tanggal_mulai',
        'tanggal_selesai',
        'slot_peserta',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
            'slot_peserta' => 'integer',
        ];
    }
}
