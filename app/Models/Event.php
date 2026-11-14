<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public static function validationRules(): array
    {
        return [
            'nama_event' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'tipe_event' => 'required|in:Run,Trail Run,Challenge',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'slot_peserta' => 'required|integer|min:1|max:1000000',
        ];
    }

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
            'slot_peserta' => 'integer',
        ];
    }
}
