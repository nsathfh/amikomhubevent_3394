<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model Gallery merepresentasikan tabel 'galleries' untuk menyimpan dokumentasi foto event
class Gallery extends Model
{
    // Kolom-kolom yang diperbolehkan untuk diisi secara massal (mass-assignment)
    protected $fillable = [
        'caption', // Deskripsi pendek untuk foto
        'image',   // Nama/path file gambar
    ];
}
