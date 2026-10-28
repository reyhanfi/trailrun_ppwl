<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_event' => 'Merapi Trail Run',
                'penyelenggara' => 'UGM Runners',
                'tipe_event' => 'Trail Run',
                'tanggal_mulai' => '2026-06-30',
                'tanggal_selesai' => '2026-07-02'
            ],
            [
                'nama_event' => 'Jogja City Run',
                'penyelenggara' => 'Jogja Running Club',
                'tipe_event' => 'Run',
                'tanggal_mulai' => '2026-07-05',
                'tanggal_selesai' => '2026-07-05'
            ],
            [
                'nama_event' => 'Menoreh Mountain Challenge',
                'penyelenggara' => 'Menoreh Trail Community',
                'tipe_event' => 'Challenge',
                'tanggal_mulai' => '2026-07-12',
                'tanggal_selesai' => '2026-07-13'
            ],
            [
                'nama_event' => 'Lava Tour Trail Run',
                'penyelenggara' => 'Volcano Runners',
                'tipe_event' => 'Trail Run',
                'tanggal_mulai' => '2026-07-19',
                'tanggal_selesai' => '2026-07-19'
            ],
            [
                'nama_event' => 'Borobudur Sunrise Run',
                'penyelenggara' => 'Borobudur Running Club',
                'tipe_event' => 'Run',
                'tanggal_mulai' => '2026-07-26',
                'tanggal_selesai' => '2026-07-26'
            ],
            [
                'nama_event' => 'Sumbing Trail Adventure',
                'penyelenggara' => 'Sumbing Trail Team',
                'tipe_event' => 'Trail Run',
                'tanggal_mulai' => '2026-08-02',
                'tanggal_selesai' => '2026-08-03'
            ],
            [
                'nama_event' => 'Jogja Ultra Challenge',
                'penyelenggara' => 'Jogja Ultra Runners',
                'tipe_event' => 'Challenge',
                'tanggal_mulai' => '2026-08-09',
                'tanggal_selesai' => '2026-08-10'
            ],
            [
                'nama_event' => 'Prambanan Run',
                'penyelenggara' => 'Prambanan Sport Event',
                'tipe_event' => 'Run',
                'tanggal_mulai' => '2026-08-16',
                'tanggal_selesai' => '2026-08-16'
            ],
            [
                'nama_event' => 'Lawu Trail Run',
                'penyelenggara' => 'Lawu Mountain Runners',
                'tipe_event' => 'Trail Run',
                'tanggal_mulai' => '2026-08-23',
                'tanggal_selesai' => '2026-08-24'
            ],
            [
                'nama_event' => 'Kaliurang Run Festival',
                'penyelenggara' => 'Kaliurang Running Community',
                'tipe_event' => 'Run',
                'tanggal_mulai' => '2026-08-30',
                'tanggal_selesai' => '2026-08-30'
            ],
            [
                'nama_event' => 'Gunung Kidul Trail Challenge',
                'penyelenggara' => 'Gunung Kidul Trail Team',
                'tipe_event' => 'Challenge',
                'tanggal_mulai' => '2026-09-06',
                'tanggal_selesai' => '2026-09-07'
            ],
            [
                'nama_event' => 'Merbabu Trail Run',
                'penyelenggara' => 'Merbabu Runners',
                'tipe_event' => 'Trail Run',
                'tanggal_mulai' => '2026-09-13',
                'tanggal_selesai' => '2026-09-14'
            ],
            [
                'nama_event' => 'Malioboro Night Run',
                'penyelenggara' => 'Jogja Night Runners',
                'tipe_event' => 'Run',
                'tanggal_mulai' => '2026-09-20',
                'tanggal_selesai' => '2026-09-20'
            ],
            [
                'nama_event' => 'Dieng Mountain Challenge',
                'penyelenggara' => 'Dieng Trail Community',
                'tipe_event' => 'Challenge',
                'tanggal_mulai' => '2026-09-27',
                'tanggal_selesai' => '2026-09-28'
            ],
            [
                'nama_event' => 'Sindoro Trail Run',
                'penyelenggara' => 'Sindoro Runners',
                'tipe_event' => 'Trail Run',
                'tanggal_mulai' => '2026-10-04',
                'tanggal_selesai' => '2026-10-05'
            ],
            [
                'nama_event' => 'Yogyakarta Fun Run',
                'penyelenggara' => 'Jogja Fun Run',
                'tipe_event' => 'Run',
                'tanggal_mulai' => '2026-10-11',
                'tanggal_selesai' => '2026-10-11'
            ],
            [
                'nama_event' => 'Bromo Trail Challenge',
                'penyelenggara' => 'Bromo Trail Runners',
                'tipe_event' => 'Challenge',
                'tanggal_mulai' => '2026-10-18',
                'tanggal_selesai' => '2026-10-19'
            ],
            [
                'nama_event' => 'Rinjani Trail Run',
                'penyelenggara' => 'Rinjani Trail Community',
                'tipe_event' => 'Trail Run',
                'tanggal_mulai' => '2026-10-25',
                'tanggal_selesai' => '2026-10-26'
            ],
            [
                'nama_event' => 'Jogja Marathon Run',
                'penyelenggara' => 'Jogja Marathon Team',
                'tipe_event' => 'Run',
                'tanggal_mulai' => '2026-11-01',
                'tanggal_selesai' => '2026-11-01'
            ],
            [
                'nama_event' => 'Merapi Ultimate Challenge',
                'penyelenggara' => 'Merapi Adventure Team',
                'tipe_event' => 'Challenge',
                'tanggal_mulai' => '2026-11-08',
                'tanggal_selesai' => '2026-11-09'
            ]
        ];

        foreach ($data as $event) {
            Event::create($event);
        }
    }
}