<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Lapangan;
use App\Models\Booking;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users
        $admin = User::create([
            'name' => 'Andi Wijaya',
            'email' => 'admin@angsoccer.com',
            'phone' => '+62 812-3456-7890',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        $user = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@email.com',
            'phone' => '+62 812-3456-7890',
            'role' => 'user',
            'password' => Hash::make('password'),
        ]);
    }
}
