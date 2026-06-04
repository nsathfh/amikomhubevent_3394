<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

// Controller ini menangani seluruh logika CRUD untuk data Partner di halaman admin
class PartnerController extends Controller
{
    /**
     * Menampilkan daftar partner (dengan fitur pencarian dan pagination).
     */
    public function index(Request $request)
    {
        // Mengambil input pencarian dari parameter query URL '?q=...'
        $search = $request->query('q');

        // Melakukan query ke model Partner
        $partners = Partner::when($search, function ($query, $search) {
                // Jika user mencari sesuatu, tambahkan filter WHERE name LIKE '%keyword%'
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            // Mengurutkan data partner berdasarkan waktu pembuatan terbaru (created_at DESC)
            ->latest()
            // Membatasi tampilan data maksimal 10 partner per halaman (pagination)
            ->paginate(10)
            // Memastikan parameter pencarian '?q=...' tetap ada di link navigasi halaman berikutnya
            ->withQueryString();

        // Mengirimkan data partners ke file view: resources/views/admin/partners/index.blade.php
        return view('admin.partners.index', compact('partners'));
    }

    /**
     * Menampilkan form untuk membuat partner baru.
     */
    public function create()
    {
        // Mengarahkan ke file view: resources/views/admin/partners/create.blade.php
        return view('admin.partners.create');
    }

    /**
     * Menyimpan data partner baru ke database.
     */
    public function store(Request $request)
    {
        // Melakukan validasi input dari form
        $data = $request->validate([
            // 'name' wajib diisi, berupa teks/string, maksimal 255 karakter, dan harus unik (belum terdaftar di kolom 'name' pada tabel 'partners')
            'name' => 'required|string|max:255|unique:partners,name',
            // 'logo_url' wajib diisi, harus berformat URL valid, dan maksimal 2048 karakter
            'logo_url' => 'required|url|max:2048',
        ]);

        // Menyimpan data partner baru yang lolos validasi ke tabel partners di database
        Partner::create($data);

        // Redirect kembali ke halaman index partner admin dengan membawa pesan sukses di session
        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit untuk data partner tertentu.
     * Route Model Binding secara otomatis mencari data Partner berdasarkan ID yang ada di URL
     */
    public function edit(Partner $partner)
    {
        // Mengirimkan data partner yang akan diedit ke file view: resources/views/admin/partners/edit.blade.php
        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Memperbarui data partner di database.
     */
    public function update(Request $request, Partner $partner)
    {
        // Melakukan validasi data sebelum diupdate
        $data = $request->validate([
            // 'name' wajib diisi, bertipe teks, maksimal 255 karakter. 
            // Validasi unik mengecualikan ID partner yang sedang diedit saat ini agar tidak error ketika nama tidak diubah
            'name' => 'required|string|max:255|unique:partners,name,' . $partner->id,
            'logo_url' => 'required|url|max:2048',
        ]);

        // Melakukan update data partner tersebut di database
        $partner->update($data);

        // Redirect kembali ke halaman index partner admin dengan membawa pesan sukses di session
        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil diperbarui.');
    }

    /**
     * Menghapus data partner dari database.
     */
    public function destroy(Partner $partner)
    {
        // Menghapus baris partner dari tabel partners di database
        $partner->delete();

        // Redirect kembali ke halaman index partner admin dengan membawa pesan sukses di session
        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil dihapus.');
    }
}