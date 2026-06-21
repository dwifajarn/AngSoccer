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

        // 2. Seed Lapangans (using image URLs from original HTML views)
        $lapangan1 = Lapangan::create([
            'name' => 'Anfield Stadium',
            'type' => 'Soccer',
            'surface' => 'Rumput Alami',
            'price_per_hour' => 10000000,
            'location' => 'Jakarta Selatan, Indonesia',
            'description' => 'Lapangan sepak bola dengan standar rumput alami kualitas tinggi dan tribun penonton.',
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCvEXgUgTmmp6Q3yMUPyYNjyYEjuqv_nZVMOSHPcn-JNhoYVTrd0WGG66m7drzB_6cpp48_-3wiJOTUCVpoNpjj9Lmt812QmMXzJ-K6pgdL-XJppSbMZXZYGWXVFtiwZSeSqXFnqDFbkTytzIUPyQmI-QRRaRObu993sHCIPn9gP7Bl2wuWBcONrWsz6ogsz2Hhzr-_61M5rLGJek_L4vGXsoYjJ2_-uWV1j9tn1QtO0uoIWlK7hix7oaa5vtYyNOmLaFxgjlLo3jL1',
            'rating' => 4.9,
            'status' => 'active',
        ]);

        $lapangan2 = Lapangan::create([
            'name' => 'Camp Nou Arena',
            'type' => 'Soccer',
            'surface' => 'Rumput Alami',
            'price_per_hour' => 5000000,
            'location' => 'Surabaya, Jawa Timur',
            'description' => 'Lapangan premium berstandar internasional dengan pencahayaan malam yang sangat terang.',
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBbyujzRQUiurSjj8tBduXwSx2BZeX5As4LqbatgPamquq5N-EYrk2JnHOANys9Nkod1E28EBOmj6cG67iqA2f0XTeZyvN8nZWE3R6emcV1CCPlrEs4prLFkZ2QnjXmAIr9oKo6ugRnAeDUCy0SJyn0jNEiIXv6sKP7kDWskgzzf-5VsVSN_3xIryNEAMQ2hNOXLfE0FPpPuwHNdelraBSoaWMGDn37OZolE0xPoTJy_tJaaZP3Mx3JX95mkZfU9fEUiChupGWeO9i8',
            'rating' => 5.0,
            'status' => 'active',
        ]);

        $lapangan3 = Lapangan::create([
            'name' => 'Allianz Arena Mini',
            'type' => 'Soccer',
            'surface' => 'Sintetis',
            'price_per_hour' => 8000000,
            'location' => 'Depok, Jawa Barat',
            'description' => 'Mini soccer modern dengan rumput sintetis premium, nyaman untuk permainan sore hari.',
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBXCQGrxsLHYzcGEGyYKo0qua13pVaKzRyAtKnPeordU5yCBI-gDoneMHXfQj_ax2URnIFCG0P8ZYHWQmrENrAOLPmIgF7lWkyitLPUkENGzJ0t_OZfFFaHPiGuzRFWE3uozrgEw2szLXkWTSGhfQMrvMyfMtSzGcUljLyiqSzcyU5LJ5IVYPHQ_uk1bSN-4dvuvPEVqtgySmHOjgo7red5v9H9Dtu5Slx01uuAp3RPYm8_sy0MIQskb5cVgVs1H98tdWOfKSBhdQOa',
            'rating' => 4.6,
            'status' => 'active',
        ]);

        // 3. Seed Bookings for Budi Santoso
        Booking::create([
            'booking_code' => 'BK-9021',
            'user_id' => $user->id,
            'lapangan_id' => $lapangan2->id,
            'date' => '2026-06-26',
            'time' => '17:00 - 18:00',
            'duration' => 1,
            'total_price' => 5000000,
            'status' => 'paid',
            'notes' => 'Butuh rompi latihan warna kuning.',
        ]);

        Booking::create([
            'booking_code' => 'BK-8842',
            'user_id' => $user->id,
            'lapangan_id' => $lapangan3->id, // San Siro Futsal
            'date' => '2026-06-27',
            'time' => '16:00 - 17:00',
            'duration' => 1,
            'total_price' => 8000000,
            'status' => 'pending',
            'notes' => null,
        ]);

        Booking::create([
            'booking_code' => 'BK-8731',
            'user_id' => $user->id,
            'lapangan_id' => $lapangan1->id, // Anfield Stadium
            'date' => '2026-06-28',
            'time' => '19:00 - 21:00',
            'duration' => 2,
            'total_price' => 20000000,
            'status' => 'cancelled',
            'notes' => 'Dibatalkan karena cuaca buruk.',
        ]);
    }
}
