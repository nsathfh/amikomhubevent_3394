<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin Utama
        $admin = \App\Models\User::create([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // 2. Akun Penyelenggara (Organizer)
        $organizer = \App\Models\User::create([
            'name' => 'HIMA Informatika',
            'email' => 'hima@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'organizer',
        ]);

        // 3. Insert Kategori Event
        $category = \App\Models\Category::create([
            'name' => 'Seminar IT',
            'slug' => 'seminar-it',
        ]);

        $category2 = \App\Models\Category::firstOrCreate([
            'name' => 'Entertaiment',
            'slug' => 'entertaiment',
        ]);

        // 4. Insert Sampel Events (Approved)
        \App\Models\Event::create([
            'category_id' => $category2->id,
            'user_id' => $admin->id,
            'title' => 'Jazz Night 2025',
            'description' => "Nikmati malam yang indah dengan alunan musik jazz yang merdu.",
            'date' => now()->addDays(30), // Mendatang
            'location' => 'Amikom Baru',
            'price' => 50000,
            'stock' => 100,
            'status' => 'approved',
            'poster_path' => 'posters/event-1.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category->id,
            'user_id' => $organizer->id,
            'title' => 'Hackaton - Unleash Your Inner Developer',
            'description' => "Ayo asah skill coding kamu dan ciptakan solusi inovatif untuk tantangan masa depan!",
            'date' => now()->addDays(15), // Mendatang
            'location' => 'Inkubator Amikom',
            'price' => 25000,
            'stock' => 100,
            'status' => 'approved',
            'poster_path' => 'posters/event-2.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category->id,
            'user_id' => $admin->id,
            'title' => 'AI & FUTURE TECH SUMMIT 2026',
            'description' => "Jelajahi tren terkini dalam kecerdasan buatan dan teknologi masa depan bersama para ahli di bidangnya.",
            'date' => now()->subDays(2), // Sudah Berlalu (Untuk test ulasan/reviews di tiket)
            'location' => 'Cinema Unit 6',
            'price' => 50000,
            'stock' => 100,
            'status' => 'approved',
            'poster_path' => 'posters/event-3.png',
        ]);

        // Workshop Laravel Pemula (Event GRATIS untuk test bypass checkout)
        \App\Models\Event::create([
            'category_id' => $category->id,
            'user_id' => $organizer->id,
            'title' => 'Workshop Laravel Pemula',
            'description' => "Pelajari dasar-dasar Laravel 11 dari nol sampai online.",
            'date' => now()->addDays(5), // Mendatang
            'location' => 'Lab Komputer 4',
            'price' => 0,
            'stock' => 50,
            'status' => 'approved',
            'poster_path' => 'posters/event-2.png',
        ]);

        // Seminar Pending (Untuk test persetujuan Superadmin)
        \App\Models\Event::create([
            'category_id' => $category->id,
            'user_id' => $organizer->id,
            'title' => 'Seminar Cyber Security 2026',
            'description' => "Bagaimana mengamankan sistem Anda dari serangan cyber terbaru.",
            'date' => now()->addDays(10), // Mendatang
            'location' => 'Aula BSC',
            'price' => 10000,
            'stock' => 120,
            'status' => 'pending',
            'poster_path' => 'posters/event-1.png',
        ]);

        // 5. Seed Coupon
        \App\Models\Coupon::create([
            'code' => 'MAHASISWA50',
            'discount_percent' => 50,
            'is_active' => true,
        ]);

        // 6. Seed Partners
        $this->call(PartnerSeeder::class);
    }
}
