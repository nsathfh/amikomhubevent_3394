<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penyelenggara - AmikomEventHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #311042 100%);
        }
        .glass {
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4 overflow-hidden relative">
    <!-- Decorative background blobs -->
    <div class="absolute w-80 h-80 rounded-full bg-indigo-500/20 blur-3xl -top-20 -left-20 animate-pulse duration-10000"></div>
    <div class="absolute w-80 h-80 rounded-full bg-fuchsia-500/20 blur-3xl -bottom-20 -right-20 animate-pulse duration-7000"></div>

    <div class="w-full max-w-md z-10">
        <!-- Logo Header -->
        <div class="flex flex-col items-center mb-8">
            <a href="/" class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-600 shadow-lg shadow-indigo-500/50 text-xl font-black text-white mb-3">
                AH
            </a>
            <h1 class="text-2xl font-extrabold text-white tracking-tight">AmikomEventHub</h1>
            <p class="text-sm text-slate-400 font-medium mt-1">Registrasi Akun Kepanitiaan / HIMA</p>
        </div>

        <!-- Registration Card -->
        <div class="glass rounded-3xl p-8 shadow-2xl shadow-black/40">
            <h2 class="text-xl font-bold text-white mb-6">Buat Akun Penyelenggara</h2>

            <form action="{{ route('organizer.register') }}" method="POST" class="space-y-5">
                @csrf
                
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Nama Kepanitiaan / HIMA</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border @error('name') border-red-500/50 focus:border-red-500 @else border-slate-700 focus:border-indigo-500 @enderror text-white placeholder-slate-500 outline-none transition focus:ring-1 focus:ring-indigo-500/50"
                        placeholder="Contoh: HMIF Amikom">
                    @error('name')
                        <p class="mt-2 text-xs text-red-400 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border @error('email') border-red-500/50 focus:border-red-500 @else border-slate-700 focus:border-indigo-500 @enderror text-white placeholder-slate-500 outline-none transition focus:ring-1 focus:ring-indigo-500/50"
                        placeholder="hima@amikom.ac.id">
                    @error('email')
                        <p class="mt-2 text-xs text-red-400 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Kata Sandi</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border @error('password') border-red-500/50 focus:border-red-500 @else border-slate-700 focus:border-indigo-500 @enderror text-white placeholder-slate-500 outline-none transition focus:ring-1 focus:ring-indigo-500/50"
                        placeholder="••••••••">
                    @error('password')
                        <p class="mt-2 text-xs text-red-400 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Konfirmasi Kata Sandi</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border border-slate-700 focus:border-indigo-500 text-white placeholder-slate-500 outline-none transition focus:ring-1 focus:ring-indigo-500/50"
                        placeholder="••••••••">
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                    class="w-full py-3 px-4 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm tracking-wide shadow-lg shadow-indigo-600/20 hover:shadow-indigo-500/30 transition transform active:scale-[0.98] duration-200">
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-6 text-center text-sm">
                <span class="text-slate-400">Sudah punya akun?</span>
                <a href="{{ route('login') }}" class="text-indigo-400 font-bold hover:underline ml-1">Masuk di sini</a>
            </div>
        </div>

        <!-- Footer Info -->
        <p class="text-center text-xs text-slate-500 mt-8">
            &copy; 2026 AmikomEventHub. Semua hak cipta dilindungi.
        </p>
    </div>
</body>
</html>
