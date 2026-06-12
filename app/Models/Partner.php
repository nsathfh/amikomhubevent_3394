<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model Partner merepresentasikan tabel 'partners' di database
class Partner extends Model
{
    // $fillable digunakan untuk mendefinisikan kolom mana saja yang boleh diisi secara massal (mass-assignment)
    // misalnya saat memanggil Partner::create($request->all()) atau Partner::update($request->all())
    protected $fillable = [
        'name',      // Nama partner
        'logo_url',  // URL gambar logo partner
    ];
}