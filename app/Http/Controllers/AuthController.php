<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login admin.
     */
    public function showLogin()
    {
        // Jika admin sudah login, langsung alihkan ke dashboard admin tanpa perlu login lagi
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Tampilkan view login admin
        return view('admin.login');
    }

    /**
     * Proses autentikasi admin.
     */
    public function login(Request $request)
    {
        // Validasi input email dan password dengan pesan error bahasa Indonesia
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Lakukan percobaan login (Auth::attempt) dengan opsi 'Ingat Saya'
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            
            // Pengecekan otorisasi: pastikan role pengguna adalah 'admin'
            if (Auth::user()->role === 'admin') {
                // Regenerasi session ID untuk menghindari session fixation attack
                $request->session()->regenerate();
                // Alihkan ke URL yang dituju (intended) atau ke dashboard admin
                return redirect()->intended(route('admin.dashboard'));
            }

            // Jika pengguna bukan admin, keluarkan dari sesi (logout) demi keamanan
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Kembalikan ke halaman login dengan pesan error otorisasi
            return back()->withErrors([
                'email' => 'Akses ditolak. Akun Anda tidak memiliki hak akses administrator.',
            ])->onlyInput('email');
        }

        // Jika email atau password salah, kembalikan dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Proses logout admin.
     */
    public function logout(Request $request)
    {
        // Lakukan logout
        Auth::logout();

        // Hapus data session aktif dan regenerasi token CSRF baru demi keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Alihkan ke halaman login dengan pesan sukses logout
        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}
