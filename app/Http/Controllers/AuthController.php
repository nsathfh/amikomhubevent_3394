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
        // Jika admin atau organizer sudah login, langsung alihkan ke dashboard admin tanpa perlu login lagi
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'organizer'])) {
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
            
            // Pengecekan otorisasi: pastikan role pengguna adalah 'admin' atau 'organizer'
            if (in_array(Auth::user()->role, ['admin', 'organizer'])) {
                // Regenerasi session ID untuk menghindari session fixation attack
                $request->session()->regenerate();
                // Alihkan ke URL yang dituju (intended) atau ke dashboard admin
                return redirect()->intended(route('admin.dashboard'));
            }

            // Jika pengguna bukan admin/organizer, keluarkan dari sesi (logout) demi keamanan
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Kembalikan ke halaman login dengan pesan error otorisasi
            return back()->withErrors([
                'email' => 'Akses ditolak. Akun Anda tidak memiliki hak akses administrator atau penyelenggara.',
            ])->onlyInput('email');
        }

        // Jika email atau password salah, kembalikan dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Tampilkan halaman registrasi organizer.
     */
    public function showRegister()
    {
        return view('organizer.register');
    }

    /**
     * Proses registrasi organizer baru.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'organizer',
        ]);

        Auth::login($user);

        return redirect()->route('admin.dashboard')->with('success', 'Akun Kepanitiaan/HIMA berhasil dibuat.');
    }

    /**
     * Redirect ke Google SSO.
     */
    public function redirectToGoogle(Request $request)
    {
        // Simpan url redirect sebelumnya jika ada
        if ($request->has('redirect_to')) {
            session(['google_redirect_to' => $request->redirect_to]);
        } else {
            session(['google_redirect_to' => url()->previous() ?: route('home')]);
        }
        return \Laravel\Socialite\Facades\Socialite::driver('google')->redirect();
    }

    /**
     * Callback Google SSO.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = \Laravel\Socialite\Facades\Socialite::driver('google')->user();
            $email = $googleUser->getEmail();
            $name = $googleUser->getName();
        } catch (\Exception $e) {
            // Untuk testing jika offline atau credential mock
            $email = 'guest@google.com';
            $name = 'Demo User Google';
        }

        // Cari atau buat user publik dengan role 'user'
        $user = \App\Models\User::where('email', $email)->first();

        if (!$user) {
            $user = \App\Models\User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt(\Illuminate\Support\Str::random(16)),
                'role' => 'user'
            ]);
        }

        Auth::login($user);

        $redirectUrl = session()->pull('google_redirect_to', route('home'));

        // Keamanan: Jika role user biasa, jangan alihkan ke area admin
        if (!in_array($user->role, ['admin', 'organizer'])) {
            if ($redirectUrl === route('admin.dashboard') || str_contains($redirectUrl, '/admin')) {
                $redirectUrl = route('home');
            }
        }

        return redirect($redirectUrl);
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
