<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Seeder digunakan untuk membuat data dummy (palsu) di dalam database secara otomatis untuk keperluan testing
class PartnerSeeder extends Seeder
{
    /**
     * Jalankan proses seeding ke database.
     */
    public function run(): void
    {
        // Looping sebanyak 5 kali untuk membuat 5 data partner dummy
        for ($i = 0; $i < 5; $i++) {
            // Partner::create() adalah metode Eloquent ORM untuk memasukkan baris baru ke tabel partners
            Partner::create([
                // fake()->company digunakan untuk menghasilkan nama perusahaan fiktif secara acak menggunakan library Faker
                'name' => fake()->company,
                
                // Menghasilkan URL gambar logo dummy menggunakan placehold.co dengan teks berupa nama perusahaan acak
                'logo_url' => 'https://placehold.co/200x200?text=' . urlencode(fake()->company),
            ]);
        }
    }
}
