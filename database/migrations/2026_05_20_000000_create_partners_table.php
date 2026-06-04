<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration digunakan untuk merancang dan mengubah struktur tabel di database menggunakan kode (version control database)
return new class extends Migration
{
    /**
     * Jalankan proses pembuatan tabel / kolom baru (migration).
     */
    public function up(): void
    {
        // Membuat tabel baru bernama 'partners' di database
        Schema::create('partners', function (Blueprint $table) {
            // Kolom 'id' bertipe primary key, auto-increment
            $table->id();
            
            // Kolom 'name' bertipe VARCHAR/string untuk nama partner
            $table->string('name');
            
            // Kolom 'logo_url' bertipe VARCHAR/string untuk URL gambar logo partner
            $table->string('logo_url');
            
            // Kolom 'created_at' dan 'updated_at' bertipe timestamp untuk mencatat waktu data dibuat/diubah
            $table->timestamps();
        });
    }

    /**
     * Jalankan proses pembatalan perubahan (rollback).
     */
    public function down(): void
    {
        // Menghapus tabel 'partners' jika tabel tersebut ada di database
        Schema::dropIfExists('partners');
    }
};