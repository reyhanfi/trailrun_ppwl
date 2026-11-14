<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@jatrilrun.com'],
            [
                'name' => 'Admin Jatrilrun',
                'password' => Hash::make('admin123'),
                'level' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@jatrilrun.com'],
            [
                'name' => 'User Jatrilrun',
                'password' => Hash::make('user123'),
                'level' => 'user',
            ]
        );

        $this->call(EventSeeder::class);
    }
}
