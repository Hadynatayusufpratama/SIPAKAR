<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk SIPAKAR - Konservasi Sumber Daya Alam</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 font-sans antialiased">

    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-12 w-full overflow-hidden">
        
        <!-- SISI KIRI: Panel Visual/Branding (Hidden di mobile, tampil elegan di Desktop) -->
        <div class="hidden lg:flex lg:col-span-7 relative bg-emerald-950 flex-col justify-between p-12 text-white overflow-hidden">
            <!-- Background Pattern / Overlay Gradient -->
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-900/90 via-emerald-950/95 to-slate-950/90 z-10"></div>
            <!-- Anda bisa mengganti URL gambar background di bawah ini sesuai selera -->
            <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('https://images.unsplash.com/photo-1511497584788-876761142212?q=80&w=1920&auto=format&fit=crop');"></div>

            <!-- Header Konten Kiri -->
            <div class="relative z-20 flex items-center space-x-3">
                <div class="bg-white/10 p-2.5 rounded-xl backdrop-blur-md border border-white/10 shadow-lg">
                    <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round5" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <span class="block text-xs uppercase tracking-widest text-emerald-400 font-semibold">BKSDA Sulawesi Tengah</span>
                    <span class="text-lg font-bold tracking-tight text-white">SIPAKAR</span>
                </div>
            </div>

            <!-- Tengah Konten Kiri (Quote / Tagline) -->
            <div class="relative z-20 my-auto max-w-lg">
                <span class="inline-block px-3 py-1 bg-emerald-500/20 border border-emerald-500/30 text-emerald-300 text-xs font-semibold rounded-full mb-6 backdrop-blur-md">
                    Sistem Pelayanan Konservasi & Penelitian
                </span>
                <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-6 text-white">
                    Kelola Perizinan Penelitian Kawasan Lebih Mudah.
                </h1>
                <p class="text-slate-300 text-base leading-relaxed">
                    Platform digital terpadu untuk pengajuan Surat Izin Masuk Kawasan Konservasi (SIMAKSI) secara transparan, cepat, dan akurat.
                </p>
            </div>

            <!-- Footer Konten Kiri -->
            <div class="relative z-20 text-xs text-slate-400 flex items-center justify-between border-t border-white/10 pt-6">
                <p>&copy; 2026 Balai Konservasi Sumber Daya Alam Sulawesi Tengah.</p>
                <div class="flex space-x-4">
                    <span>Keamanan Terjamin</span>
                    <span>•</span>
                    <span>Layanan Resmi</span>
                </div>
            </div>
        </div>

        <!-- SISI KANAN: Form Login Utama -->
        <div class="col-span-1 lg:col-span-5 flex items-center justify-center p-6 sm:p-12 bg-white">
            <div class="w-full max-w-md space-y-8">
                
                <!-- Logo & Judul Mobile/Header Form -->
                <div class="text-center lg:text-left">
                    <div class="flex justify-center lg:justify-start mb-4">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/29/Logo_Kementerian_Kehutanan_Republik_Indonesia_%282024%29.svg" alt="Logo Kemenhut" class="h-16 w-auto object-contain">
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        Selamat Datang
                    </h2>
                    <p class="text-sm text-slate-500 mt-2">
                        Silakan masuk menggunakan akun terdaftar Anda untuk melanjutkan.
                    </p>
                </div>

                <!-- Session Status / Pesan Error bawaan Laravel -->
                @if (session('status'))
                    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Form Login Laravel Breeze / Jetstream / Custom -->
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Input Email -->
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Alamat Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                            </span>
                            <input id="email" type="emailname" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-900 outline-none focus:ring-2 focus:ring-emerald-600 focus:bg-white transition-all shadow-sm"
                                placeholder="nama@email.com">
                        </div>
                        @error('email')
                            <span class="text-xs text-rose-600 mt-1.5 block font-medium">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Input Password -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-600">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-semibold text-emerald-700 hover:text-emerald-800">
                                    Lupa sandi?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </span>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-900 outline-none focus:ring-2 focus:ring-emerald-600 focus:bg-white transition-all shadow-sm"
                                placeholder="••••••••">
                        </div>
                        @error('password')
                            <span class="text-xs text-rose-600 mt-1.5 block font-medium">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="remember" id="remember_me" class="w-4 h-4 rounded text-emerald-600 border-slate-300 focus:ring-emerald-500">
                            <span class="text-slate-600 text-xs font-medium">Ingat Saya</span>
                        </label>
                    </div>

                    <!-- Tombol Masuk -->
                    <button type="submit" class="w-full py-3.5 px-4 bg-emerald-900 hover:bg-emerald-950 text-white font-bold rounded-xl shadow-lg shadow-emerald-900/20 transition-all duration-200 flex items-center justify-center space-x-2 text-sm tracking-wide">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Masuk ke Akun</span>
                    </button>

                    <!-- Link Registrasi -->
                    @if (Route::has('register'))
                        <p class="text-center text-xs text-slate-500 pt-4 border-t border-slate-100">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="font-bold text-emerald-700 hover:text-emerald-800 ml-1">
                                Daftar di sini
                            </a>
                        </p>
                    @endif
                </form>

            </div>
        </div>

    </div>

</body>
</html>