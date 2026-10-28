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
        'tanggal_selesai'
    ];
}