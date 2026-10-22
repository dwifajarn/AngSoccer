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
        $admin = User::firstOrCreate(
            ['email' => 'admin@angsoccer.com'],
            [
                'name' => 'Andi Wijaya',
                'phone' => '+62 812-3456-7890',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ]
        );

        $user = User::firstOrCreate(
            ['email' => 'budi.santoso@email.com'],
            [
                'name' => 'Budi Santoso',
                'phone' => '+62 812-3456-7890',
                'role' => 'user',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Seed Lapangan
        $lapangan1 = Lapangan::updateOrCreate(
            ['name' => 'Mini Soccer Sintetis A'],
            [
                'type' => 'Soccer',
                'surface' => 'Sintetis',
                'location' => 'Arena AngSoccer 1 - Jakarta Selatan',
                'price_per_hour' => 350000,
                'image_url' => 'https://images.unsplash.com/photo-1529900245534-47fbf028b1db?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Lapangan mini soccer berstandar internasional dengan rumput sintetis monofilament setinggi 5cm, empuk dan aman untuk lutut. Dilengkapi penerangan floodlight LED 800W untuk pertandingan malam hari.',
                'facilities' => 'Rumput Sintetis Premium, Floodlight LED, Ruang Ganti Ber-AC, Toilet Bersih, Shower Air Hangat, Parkir Luas, Free Rompi & Bola',
                'rating' => 4.9,
                'status' => 'active',
            ]
        );

        $lapangan2 = Lapangan::updateOrCreate(
            ['name' => 'Lapangan Futsal Vinyl B'],
            [
                'type' => 'Futsal',
                'surface' => 'Vinyl',
                'location' => 'Arena AngSoccer 2 - Jakarta Selatan',
                'price_per_hour' => 200000,
                'image_url' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Lapangan futsal indoor dengan lantai vinyl shock-absorption standar FIFA. Cocok untuk kecepatan tinggi, manuver tajam, dan tidak licin.',
                'facilities' => 'Lantai Vinyl Standar FIFA, Tribun Penonton, Papan Skor Digital, Sound System, Kantin & Musholla, Rompi & Bola Futsal',
                'rating' => 4.8,
                'status' => 'active',
            ]
        );

        $lapangan3 = Lapangan::updateOrCreate(
            ['name' => 'Mini Soccer Rumput Alami'],
            [
                'type' => 'Soccer',
                'surface' => 'Rumput Alami',
                'location' => 'Arena AngSoccer 3 - Tangerang Selatan',
                'price_per_hour' => 300000,
                'image_url' => 'https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Lapangan mini soccer outdoor dengan rumput alami jenis Zoysia Matrella yang terawat prima dan sistem drainase bawah tanah anti-genangan saat hujan.',
                'facilities' => 'Rumput Alami Zoysia Matrella, Drainase Anti Banjir, Bench Pemain Cadangan, Ruang Medis P3K, Area Parkir Bus & Mobil, Air Mineral Galon',
                'rating' => 4.7,
                'status' => 'active',
            ]
        );

        $lapangan4 = Lapangan::updateOrCreate(
            ['name' => 'Lapangan Futsal Interlock C'],
            [
                'type' => 'Futsal',
                'surface' => 'Interlock',
                'location' => 'Arena AngSoccer 1 - Jakarta Selatan',
                'price_per_hour' => 180000,
                'image_url' => 'https://images.unsplash.com/photo-1518604666860-9ed391f76460?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Lantai modular interlock polypropylene kualitas turnamen. Daya cengkeram sepatu maksimal dan pantulan bola stabil.',
                'facilities' => 'Lantai Interlock Modular, Ruang Ganti, Toilet, Loker Kunci, Parkir Motor & Mobil, Jaring Pengaman Keliling',
                'rating' => 4.8,
                'status' => 'active',
            ]
        );

        // 3. Seed Sample Booking for testing time-slot grid
        Booking::firstOrCreate(
            ['booking_code' => 'BK-1001'],
            [
                'user_id' => $user->id,
                'lapangan_id' => $lapangan1->id,
                'date' => now()->toDateString(),
                'time' => '19:00 - 21:00',
                'duration' => 2,
                'total_price' => 700000,
                'status' => 'paid',
                'notes' => 'Sparing komunitas bola malam',
            ]
        );
    }
}
