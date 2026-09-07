<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPAKAR - Balai KSDA Sulawesi Tengah</title>
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased min-h-screen flex flex-col">

    <!-- Main Layout Wrapper dengan Nuansa Hijau Khas Kehutanan / Admin Konservasi -->
    <div class="flex-1 flex flex-col lg:flex-row">

        <!-- SIDEBAR / NAVBAR PROFESIONAL KIRI (HIJAU KELAS ADMIN) -->
        <aside class="w-full lg:w-72 bg-gradient-to-b from-emerald-950 via-slate-900 to-teal-950 text-white flex flex-col justify-between shadow-2xl shrink-0 border-r border-emerald-800/40">
            <div>
                <!-- Brand Header -->
                <div class="p-6 border-b border-emerald-800/60 bg-emerald-950/40 flex flex-col items-center text-center">
                    <div class="bg-white p-3 rounded-2xl shadow-lg border border-emerald-100/20 mb-3 transform hover:scale-105 transition-transform duration-300">
                        <img src="{{ asset('images/logo_bksda.png') }}" alt="Logo BKSDA" class="h-16 w-auto object-contain">
                    </div>
                    <div>
                        <h2 class="font-black text-sm tracking-wide text-white leading-tight">BKSDA SULAWESI TENGAH</h2>
                        <span class="text-[11px] text-emerald-300 font-semibold uppercase tracking-widest mt-1 inline-block">SIPAKAR Online System</span>
                    </div>
                </div>

                <!-- Menu Navigasi Samping (Tab Trigger) -->
                <div class="p-4 space-y-2 mt-2">
                    <p class="px-3 text-[10px] font-bold text-emerald-400 uppercase tracking-widest mb-2">Menu Utama Layanan</p>
                    
                    <button class="nav-tab-btn active w-full flex items-center gap-3 px-4 py-3.5 rounded-2xl text-xs font-bold bg-gradient-to-r from-emerald-800 to-teal-800 text-white shadow-lg shadow-emerald-950/50 transition-all cursor-pointer border border-emerald-600/30" id="btn-tab-form" onclick="toggleTab('form')">
                        <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center text-amber-400"><i class="fa-solid fa-file-pen"></i></div>
                        <span class="text-left flex-1">Form Pengajuan Baru</span>
                        <i class="fa-solid fa-chevron-right text-[10px] text-emerald-400"></i>
                    </button>

                    <button class="nav-tab-btn w-full flex items-center gap-3 px-4 py-3.5 rounded-2xl text-xs font-semibold text-emerald-200 hover:bg-white/5 hover:text-white transition-all cursor-pointer border border-transparent" id="btn-tab-status" onclick="toggleTab('status')">
                        <div class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center text-teal-400"><i class="fa-solid fa-list-check"></i></div>
                        <span class="text-left flex-1">Status & Permohonan</span>
                        <span class="bg-amber-500 text-emerald-950 font-bold px-2 py-0.5 rounded-full text-[10px]">{{ $totalPermohonan ?? 0 }}</span>
                    </button>

                    <button class="nav-tab-btn w-full flex items-center gap-3 px-4 py-3.5 rounded-2xl text-xs font-semibold text-emerald-200 hover:bg-white/5 hover:text-white transition-all cursor-pointer border border-transparent" id="btn-tab-profile" onclick="toggleTab('profile')">
                        <div class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center text-emerald-400"><i class="fa-solid fa-user-gear"></i></div>
                        <span class="text-left flex-1">Profil Saya</span>
                    </button>
                </div>
            </div>

            <!-- Profil User & Logout di Bagian Bawah Sidebar -->
            <div class="p-4 m-4 bg-emerald-950/80 rounded-2xl border border-emerald-800/80">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-500 to-amber-400 flex items-center justify-center text-emerald-950 font-extrabold shadow-md">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-[10px] text-emerald-300 uppercase tracking-wider font-bold">Login Sebagai</p>
                        <p class="text-xs font-extrabold text-white truncate">{{ Auth::user()->name ?? 'Hadynata Yusuf Pratama' }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-red-500/20 hover:bg-red-600 text-red-200 hover:text-white border border-red-500/30 py-2.5 rounded-xl text-xs font-bold flex items-center justify-center gap-2 transition-all">
                        <i class="fa-solid fa-right-from-bracket"></i> Keluar Sistem
                    </button>
                </form>
            </div>
        </aside>

        <!-- KONTEN UTAMA DASHBOARD -->
        <main class="flex-1 p-4 sm:p-8 overflow-y-auto">

            <!-- Top Header Page Info -->
            <div class="flex justify-between items-center flex-wrap gap-4 mb-8 bg-white p-6 rounded-3xl shadow-sm border border-slate-200/80">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="bg-emerald-100 text-emerald-800 font-bold px-2.5 py-0.5 rounded-md text-[10px] uppercase">Dashboard Layanan</span>
                        <span class="text-slate-400 text-xs">/ SIPAKAR BKSDA Sulteng</span>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Sistem Perizinan Akses Kawasan Konservasi</h1>
                </div>
                <div class="flex items-center gap-3">
                    <div class="px-4 py-2 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center gap-2 text-xs font-bold text-emerald-900">
                        <i class="fa-solid fa-circle-check text-emerald-600"></i> Status Akun: Aktif
                    </div>
                </div>
            </div>

            <!-- Notifikasi Pesan Sukses / Error -->
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-900 p-4 rounded-2xl mb-8 flex items-center gap-4 text-sm font-semibold shadow-md">
                    <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-circle-check text-lg"></i>
                    </div>
                    <div>
                        <h5 class="font-bold text-emerald-950">Berhasil!</h5>
                        <p class="text-xs text-emerald-800">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-900 p-5 rounded-2xl mb-8 shadow-md text-sm">
                    <div class="font-bold text-red-950 flex items-center gap-2 mb-2">
                        <i class="fa-solid fa-triangle-exclamation text-red-600"></i> Perhatian: Terdapat kesalahan pengisian formulir
                    </div>
                    <ul class="list-disc pl-5 space-y-1 text-xs text-red-800">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- KARTU STATISTIK -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <!-- Stat 1 -->
                <div class="bg-gradient-to-br from-white via-amber-50/40 to-amber-100/50 p-6 rounded-3xl border border-amber-200/80 shadow-lg shadow-amber-900/5 flex items-center justify-between relative overflow-hidden group">
                    <div class="absolute -right-4 -bottom-4 w-28 h-28 bg-amber-500/10 rounded-full group-hover:scale-125 transition-transform"></div>
                    <div>
                        <p class="text-[11px] font-extrabold text-amber-800 uppercase tracking-wider mb-1">Dalam Proses Verifikasi</p>
                        <h4 class="text-3xl font-extrabold text-slate-900">{{ $totalPending ?? 0 }} <span class="text-xs font-normal text-slate-500">Berkas</span></h4>
                        <p class="text-[11px] text-slate-500 mt-1 flex items-center gap-1"><i class="fa-solid fa-clock-rotate-left text-amber-600"></i> Menunggu tinjauan admin</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-amber-500 to-amber-400 text-white flex items-center justify-center text-2xl shadow-lg shadow-amber-500/30">
                        <i class="fa-solid fa-hourglass-half"></i>
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="bg-gradient-to-br from-white via-emerald-50/40 to-emerald-100/50 p-6 rounded-3xl border border-emerald-200/80 shadow-lg shadow-emerald-900/5 flex items-center justify-between relative overflow-hidden group">
                    <div class="absolute -right-4 -bottom-4 w-28 h-28 bg-emerald-500/10 rounded-full group-hover:scale-125 transition-transform"></div>
                    <div>
                        <p class="text-[11px] font-extrabold text-emerald-800 uppercase tracking-wider mb-1">Permohonan Disetujui</p>
                        <h4 class="text-3xl font-extrabold text-slate-900">{{ $totalDisetujui ?? 0 }} <span class="text-xs font-normal text-slate-500">Izin</span></h4>
                        <p class="text-[11px] text-slate-500 mt-1 flex items-center gap-1"><i class="fa-solid fa-circle-check text-emerald-600"></i> Surat izin siap diunduh</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-emerald-700 to-teal-600 text-white flex items-center justify-center text-2xl shadow-lg shadow-emerald-700/30">
                        <i class="fa-solid fa-shield-check"></i>
                    </div>
                </div>

                <!-- Stat 3 -->
                <div class="bg-gradient-to-br from-white via-teal-50/40 to-teal-100/50 p-6 rounded-3xl border border-teal-200/80 shadow-lg shadow-teal-900/5 flex items-center justify-between relative overflow-hidden group">
                    <div class="absolute -right-4 -bottom-4 w-28 h-28 bg-teal-500/10 rounded-full group-hover:scale-125 transition-transform"></div>
                    <div>
                        <p class="text-[11px] font-extrabold text-teal-800 uppercase tracking-wider mb-1">Total Keseluruhan</p>
                        <h4 class="text-3xl font-extrabold text-slate-900">{{ $totalPermohonan ?? 0 }} <span class="text-xs font-normal text-slate-500">Total</span></h4>
                        <p class="text-[11px] text-slate-500 mt-1 flex items-center gap-1"><i class="fa-solid fa-folder-tree text-teal-600"></i> Arsip permohonan Anda</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-teal-600 to-emerald-800 text-white flex items-center justify-center text-2xl shadow-lg shadow-teal-600/30">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                </div>
            </div>

            <!-- SECTION TAB 1: FORMULIR PENGAJUAN BARU -->
            <div id="tab-content-form" class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-200/80 overflow-hidden mb-12">
                <div class="bg-gradient-to-r from-emerald-900 via-emerald-950 to-teal-950 text-white px-8 py-6 flex items-center justify-between flex-wrap gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center border border-white/10 text-emerald-300 text-lg">
                            <i class="fa-solid fa-file-pen"></i>
                        </div>
                        <div>
                            <h3 class="font-extrabold text-base sm:text-lg tracking-wide">Formulir SIPAKAR (Sistem Perizinan Akses Kawasan)</h3>
                            <p class="text-xs text-emerald-300">Lengkapi data permohonan izin masuk kawasan konservasi di bawah ini dengan benar.</p>
                        </div>
                    </div>
                    <span class="bg-amber-500/20 text-amber-300 border border-amber-500/30 text-xs px-3 py-1 rounded-full font-semibold">
                        <i class="fa-solid fa-asterisk text-[9px] mr-1"></i> Wajib Diisi
                    </span>
                </div>

                <div class="p-6 sm:p-10">
                    <form action="{{ route('simaksi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- 1. Data Identitas Pemohon -->
                        <div class="mb-10">
                            <div class="flex items-center gap-3 border-b border-slate-200 pb-3 mb-6">
                                <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-xs">
                                    <i class="fa-solid fa-id-card"></i>
                                </div>
                                <h4 class="text-sm font-extrabold text-emerald-950 uppercase tracking-wider">1. Data Identitas Pemohon</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="flex flex-col gap-2 md:col-span-2">
                                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Kategori Pemohon <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <select name="kategori_pemohon" id="kategori_pemohon" class="w-full px-4 py-3.5 bg-slate-50/80 border border-slate-300 rounded-2xl text-sm font-medium outline-none focus:ring-2 focus:ring-emerald-800 focus:bg-white transition-all appearance-none cursor-pointer" required onchange="toggleKategoriFields()">
                                            <option value="" disabled selected>-- Pilih Kategori Pemohon --</option>
                                            <option value="mahasiswa" {{ old('kategori_pemohon') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                            <option value="umum" {{ old('kategori_pemohon') == 'umum' ? 'selected' : '' }}>Umum</option>
                                        </select>
                                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-500">
                                            <i class="fa-solid fa-chevron-down text-xs"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Field Khusus Mahasiswa -->
                                <div id="mahasiswa-fields" style="display: none; grid-column: span 2;">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-emerald-50/50 rounded-2xl border border-emerald-200/60 mb-2">
                                        <div class="flex flex-col gap-2">
                                            <label class="text-xs font-bold text-emerald-950 uppercase tracking-wider">NIM (Nomor Induk Mahasiswa) <span class="text-red-500">*</span></label>
                                            <input type="text" name="nim" id="nim" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-800 transition-all font-medium" value="{{ old('nim') }}" placeholder="Masukkan NIM">
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <label class="text-xs font-bold text-emerald-950 uppercase tracking-wider">Program Studi (Prodi) <span class="text-red-500">*</span></label>
                                            <input type="text" name="prodi" id="prodi" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-800 transition-all font-medium" value="{{ old('prodi') }}" placeholder="Masukkan Program Studi">
                                        </div>
                                        <div class="flex flex-col gap-2 md:col-span-2">
                                            <label class="text-xs font-bold text-emerald-950 uppercase tracking-wider">Fakultas <span class="text-red-500">*</span></label>
                                            <input type="text" name="fakultas" id="fakultas" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-800 transition-all font-medium" value="{{ old('fakultas') }}" placeholder="Masukkan Fakultas">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_lengkap" class="w-full px-4 py-3.5 bg-slate-50/80 border border-slate-300 rounded-2xl text-sm font-medium outline-none focus:ring-2 focus:ring-emerald-800 focus:bg-white transition-all" value="{{ Auth::user()->name ?? '' }}" required placeholder="Nama lengkap beserta gelar">
                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">NIK / NIP <span class="text-red-500">*</span></label>
                                    <input type="text" name="nik_nip" class="w-full px-4 py-3.5 bg-slate-50/80 border border-slate-300 rounded-2xl text-sm font-medium outline-none focus:ring-2 focus:ring-emerald-800 focus:bg-white transition-all" required placeholder="Nomor Induk Kependudukan / NIP">
                                </div>

                                <div class="flex flex-col gap-2 md:col-span-2">
                                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Alamat Lengkap <span class="text-red-500">*</span></label>
                                    <textarea name="alamat" rows="2" class="w-full px-4 py-3.5 bg-slate-50/80 border border-slate-300 rounded-2xl text-sm font-medium outline-none focus:ring-2 focus:ring-emerald-800 focus:bg-white transition-all resize-y" required placeholder="Alamat domisili saat ini"></textarea>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Tempat Lahir <span class="text-red-500">*</span></label>
                                    <input type="text" name="tempat_lahir" class="w-full px-4 py-3.5 bg-slate-50/80 border border-slate-300 rounded-2xl text-sm font-medium outline-none focus:ring-2 focus:ring-emerald-800 focus:bg-white transition-all" required placeholder="Kota kelahiran">
                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Tanggal Lahir <span class="text-red-500">*</span></label>
                                    <input type="date" name="tanggal_lahir" class="w-full px-4 py-3.5 bg-slate-50/80 border border-slate-300 rounded-2xl text-sm font-medium outline-none focus:ring-2 focus:ring-emerald-800 focus:bg-white transition-all" required>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Nomor WhatsApp / HP Aktif <span class="text-red-500">*</span></label>
                                    <input type="text" name="no_hp" class="w-full px-4 py-3.5 bg-slate-50/80 border border-slate-300 rounded-2xl text-sm font-medium outline-none focus:ring-2 focus:ring-emerald-800 focus:bg-white transition-all" required placeholder="Contoh: 081234567890">
                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Asal Instansi / Universitas <span class="text-red-500">*</span></label>
                                    <input type="text" name="asal_instansi" class="w-full px-4 py-3.5 bg-slate-50/80 border border-slate-300 rounded-2xl text-sm font-medium outline-none focus:ring-2 focus:ring-emerald-800 focus:bg-white transition-all" required placeholder="Contoh: Universitas Tadulako">
                                </div>
                            </div>
                        </div>

                        <!-- 2. Detail Kegiatan / Penelitian -->
                        <div class="mb-10">
                            <div class="flex items-center gap-3 border-b border-slate-200 pb-3 mb-6">
                                <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-xs">
                                    <i class="fa-solid fa-compass"></i>
                                </div>
                                <h4 class="text-sm font-extrabold text-emerald-950 uppercase tracking-wider">2. Detail Kegiatan / Penelitian</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="flex flex-col gap-2 md:col-span-2">
                                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Judul Penelitian / Kegiatan <span class="text-red-500">*</span></label>
                                    <input type="text" name="judul_penelitian" class="w-full px-4 py-3.5 bg-slate-50/80 border border-slate-300 rounded-2xl text-sm font-medium outline-none focus:ring-2 focus:ring-emerald-800 focus:bg-white transition-all" required placeholder="Judul lengkap penelitian atau kegiatan lapangan">
                                </div>

                                <div class="flex flex-col gap-2 md:col-span-2">
                                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Tujuan Kegiatan <span class="text-red-500">*</span></label>
                                    <textarea name="tujuan_kegiatan" rows="3" class="w-full px-4 py-3.5 bg-slate-50/80 border border-slate-300 rounded-2xl text-sm font-medium outline-none focus:ring-2 focus:ring-emerald-800 focus:bg-white transition-all resize-y" required placeholder="Jelaskan tujuan pelaksanaan kegiatan secara ringkas..."></textarea>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Tanggal Mulai <span class="text-red-500">*</span></label>
                                    <input type="date" name="tanggal_mulai" class="w-full px-4 py-3.5 bg-slate-50/80 border border-slate-300 rounded-2xl text-sm font-medium outline-none focus:ring-2 focus:ring-emerald-800 focus:bg-white transition-all" required>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Tanggal Selesai <span class="text-red-500">*</span></label>
                                    <input type="date" name="tanggal_selesai" class="w-full px-4 py-3.5 bg-slate-50/80 border border-slate-300 rounded-2xl text-sm font-medium outline-none focus:ring-2 focus:ring-emerald-800 focus:bg-white transition-all" required>
                                </div>

                                <div class="flex flex-col gap-2 md:col-span-2">
                                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Lokasi Kawasan Konservasi BKSDA Sulteng <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <select name="lokasi_penelitian" class="w-full px-4 py-3.5 bg-slate-50/80 border border-slate-300 rounded-2xl text-sm font-medium outline-none focus:ring-2 focus:ring-emerald-800 focus:bg-white transition-all appearance-none cursor-pointer" required>
                                            <option value="" disabled selected>-- Pilih Kawasan Konservasi --</option>
                                            <optgroup label="Taman Wisata Alam (TWA)">
                                                <option value="TWA Wera">TWA Wera</option>
                                                <option value="TWA Bancea">TWA Bancea</option>
                                                <option value="TWA Pulau Toko Bae">TWA Pulau Toko Bae</option>
                                            </optgroup>
                                            <optgroup label="Taman Buru (TB)">
                                                <option value="Taman Buru Landusa Tomata">Taman Buru Landusa Tomata</option>
                                            </optgroup>
                                            <optgroup label="Cagar Alam (CA)">
                                                <option value="Cagar Alam Pangi Binangga">Cagar Alam Pangi Binangga</option>
                                                <option value="Cagar Alam Gunung Sojol">Cagar Alam Gunung Sojol</option>
                                                <option value="Cagar Alam Gunung Tinombala">Cagar Alam Gunung Tinombala</option>
                                                <option value="Cagar Alam Gunung Dako">Cagar Alam Gunung Dako</option>
                                                <option value="Cagar Alam Morowali">Cagar Alam Morowali</option>
                                            </optgroup>
                                            <optgroup label="Suaka Margasatwa (SM)">
                                                <option value="Suaka Margasatwa Pulau Dolangan">Suaka Margasatwa Pulau Dolangan</option>
                                                <option value="Suaka Margasatwa Bakiriang">Suaka Margasatwa Bakiriang</option>
                                            </optgroup>
                                        </select>
                                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-500">
                                            <i class="fa-solid fa-chevron-down text-xs"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Berkas Persyaratan Lampiran -->
                        <div class="mb-10">
                            <div class="flex items-center gap-3 border-b border-slate-200 pb-3 mb-6">
                                <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-xs">
                                    <i class="fa-solid fa-file-arrow-up"></i>
                                </div>
                                <h4 class="text-sm font-extrabold text-emerald-950 uppercase tracking-wider">3. Berkas Persyaratan Lampiran</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="bg-slate-50/80 border-2 border-dashed border-slate-300 p-5 rounded-2xl transition-all hover:border-emerald-700 hover:bg-emerald-50/30 group">
                                    <div class="flex flex-col gap-2">
                                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-emerald-800 shadow-sm group-hover:bg-emerald-700 group-hover:text-white transition-colors">
                                            <i class="fa-solid fa-id-card"></i>
                                        </div>
                                        <label class="text-xs font-bold text-slate-900 mt-1">Scan KTP / Identitas <span class="text-red-500">*</span></label>
                                        <p class="text-[11px] text-slate-500 leading-snug">Format: PDF/JPG/PNG. Maks 5MB.</p>
                                        <input type="file" name="file_ktp" accept=".pdf,.jpg,.jpeg,.png" required class="mt-2 text-xs file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-100 file:text-emerald-900 hover:file:bg-emerald-200 cursor-pointer text-slate-600">
                                    </div>
                                </div>

                                <div class="bg-slate-50/80 border-2 border-dashed border-slate-300 p-5 rounded-2xl transition-all hover:border-emerald-700 hover:bg-emerald-50/30 group">
                                    <div class="flex flex-col gap-2">
                                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-emerald-800 shadow-sm group-hover:bg-emerald-700 group-hover:text-white transition-colors">
                                            <i class="fa-solid fa-envelope-open-text"></i>
                                        </div>
                                        <label class="text-xs font-bold text-slate-900 mt-1">Surat Pengantar <span class="text-red-500">*</span></label>
                                        <p class="text-[11px] text-slate-500 leading-snug">Format: PDF/JPG/PNG. Maks 5MB.</p>
                                        <input type="file" name="file_surat_pengantar" accept=".pdf,.jpg,.jpeg,.png" required class="mt-2 text-xs file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-100 file:text-emerald-900 hover:file:bg-emerald-200 cursor-pointer text-slate-600">
                                    </div>
                                </div>

                                <div class="bg-slate-50/80 border-2 border-dashed border-slate-300 p-5 rounded-2xl transition-all hover:border-emerald-700 hover:bg-emerald-50/30 group">
                                    <div class="flex flex-col gap-2">
                                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-emerald-800 shadow-sm group-hover:bg-emerald-700 group-hover:text-white transition-colors">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </div>
                                        <label class="text-xs font-bold text-slate-900 mt-1">Proposal Kegiatan (PDF) <span class="text-red-500">*</span></label>
                                        <p class="text-[11px] text-slate-500 leading-snug">Format PDF resmi. Maksimal 10 MB.</p>
                                        <input type="file" name="file_proposal" accept=".pdf" required class="mt-2 text-xs file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-100 file:text-emerald-900 hover:file:bg-emerald-200 cursor-pointer text-slate-600">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex items-center justify-end pt-4 border-t border-slate-200">
                            <button type="submit" class="bg-gradient-to-r from-emerald-900 via-emerald-950 to-teal-950 text-white px-8 py-4 rounded-2xl text-sm font-bold tracking-wide shadow-xl shadow-emerald-900/20 hover:shadow-emerald-900/40 hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-3 w-full sm:w-auto justify-center cursor-pointer">
                                <i class="fa-solid fa-paper-plane"></i> Kirim Permohonan SIPAKAR
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- SECTION TAB 2: STATUS & PERMOHONAN DIKIRIM -->
            <div id="tab-content-status" class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-200/80 overflow-hidden mb-12" style="display: none;">
                <div class="bg-gradient-to-r from-emerald-900 via-emerald-950 to-teal-950 text-white px-8 py-6 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center border border-white/10 text-emerald-300 text-lg">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </div>
                        <div>
                            <h3 class="font-extrabold text-base sm:text-lg tracking-wide">Riwayat & Status Permohonan Dikirim</h3>
                            <p class="text-xs text-emerald-300">Pantau proses perizinan akses kawasan konservasi Anda secara real-time.</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse text-left text-sm">
                            <thead>
                                <tr class="bg-slate-50 text-slate-700 text-xs uppercase tracking-wider border-b-2 border-slate-200">
                                    <th class="p-4 font-bold">No</th>
                                    <th class="p-4 font-bold">Pemohon</th>
                                    <th class="p-4 font-bold">Judul Kegiatan</th>
                                    <th class="p-4 font-bold">Lokasi Kawasan</th>
                                    <th class="p-4 font-bold">Tanggal</th>
                                    <th class="p-4 font-bold">Status</th>
                                    <th class="p-4 font-bold">Jadwal & Zoom</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($permohonan ?? [] as $index => $item)
                                <tr class="hover:bg-slate-50/80 transition-all">
                                    <td class="p-4 text-slate-600 font-semibold">{{ $index + 1 }}</td>
                                    <td class="p-4 text-slate-700">
                                        <strong class="text-slate-900 block">{{ $item->nama_lengkap }}</strong>
                                        <span class="text-xs text-slate-500">{{ $item->asal_instansi }}</span>
                                    </td>
                                    <td class="p-4 text-slate-700 font-medium">{{ $item->judul_penelitian }}</td>
                                    <td class="p-4"><span class="bg-emerald-50 text-emerald-800 px-2.5 py-1 rounded-lg text-xs font-semibold border border-emerald-200">{{ $item->lokasi_penelitian }}</span></td>
                                    <td class="p-4 text-slate-600 text-xs font-medium">{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</td>
                                    <td class="p-4">
                                        @php $status = strtolower($item->status ?? 'pending'); @endphp
                                        @if($status == 'pending')
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200"><i class="fa-solid fa-spinner fa-spin"></i> Dalam Proses</span>
                                        @elseif($status == 'disetujui')
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200"><i class="fa-solid fa-circle-check"></i> Disetujui</span>
                                            @if(!empty($item->surat_izin))
                                                <a href="{{ route('simaksi.downloadPdf', $item->id) }}" class="inline-flex items-center gap-1 bg-teal-600 text-white px-3 py-1 rounded-lg text-xs font-bold mt-2" target="_blank"><i class="fa-solid fa-file-pdf"></i> Unduh Surat</a>
                                            @endif
                                        @elseif($status == 'ditolak')
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-xs font-bold bg-red-100 text-red-700 border border-red-200"><i class="fa-solid fa-circle-xmark"></i> Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-slate-600 text-xs">
                                        @if(!empty($item->link_zoom) || !empty($item->tanggal_zoom))
                                            <span class="font-semibold block mb-1"><i class="fa-regular fa-calendar text-emerald-700 mr-1"></i>{{ $item->tanggal_zoom }}</span>
                                            <a href="{{ $item->link_zoom }}" target="_blank" class="px-3 py-1 bg-emerald-600 text-white rounded-lg font-bold inline-flex items-center gap-1 shadow-sm"><i class="fa-solid fa-video"></i> Gabung Zoom</a>
                                        @else
                                            <span class="text-slate-400 italic">Belum ada jadwal</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-16 text-slate-400">
                                        <div class="w-16 h-16 bg-slate-100 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-3 text-2xl">
                                            <i class="fa-solid fa-folder-open"></i>
                                        </div>
                                        <p class="font-bold text-slate-600">Belum ada permohonan yang dikirim.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- SECTION TAB 3: PROFIL SAYA -->
            <div id="tab-content-profile" class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-200/80 overflow-hidden mb-12" style="display: none;">
                <div class="bg-gradient-to-r from-emerald-900 via-emerald-950 to-teal-950 text-white px-8 py-6 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center border border-white/10 text-emerald-300 text-lg">
                            <i class="fa-solid fa-id-card-clip"></i>
                        </div>
                        <div>
                            <h3 class="font-extrabold text-base sm:text-lg tracking-wide">Profil Akun Pemohon</h3>
                            <p class="text-xs text-emerald-300">Informasi detail mengenai akun Anda yang terdaftar pada sistem.</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 sm:p-10">
                    <div class="flex items-center gap-6 bg-gradient-to-r from-emerald-50 via-teal-50/30 to-white p-6 sm:p-8 rounded-3xl mb-8 border border-emerald-200/80 shadow-md">
                        <div class="w-20 h-20 bg-gradient-to-tr from-emerald-900 to-teal-900 text-white rounded-2xl flex items-center justify-center text-3xl shadow-xl shrink-0 border-2 border-white">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <div>
                            <span class="bg-emerald-800 text-emerald-100 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">Terverifikasi BKSDA</span>
                            <h3 class="text-xl sm:text-2xl font-extrabold text-emerald-950 mt-1">{{ Auth::user()->name ?? 'Hadynata Yusuf Pratama' }}</h3>
                            <p class="text-xs text-slate-600 mt-1 flex items-center gap-2">
                                <i class="fa-solid fa-envelope text-emerald-700"></i> {{ Auth::user()->email ?? 'hadynata@student.id' }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-slate-50/80 p-5 rounded-2xl border border-slate-200">
                            <span class="text-[10px] text-slate-400 uppercase tracking-wider font-bold block mb-1">Nama Pengguna</span>
                            <p class="text-sm font-extrabold text-slate-900">{{ Auth::user()->name ?? '-' }}</p>
                        </div>
                        <div class="bg-slate-50/80 p-5 rounded-2xl border border-slate-200">
                            <span class="text-[10px] text-slate-400 uppercase tracking-wider font-bold block mb-1">Alamat Email</span>
                            <p class="text-sm font-extrabold text-slate-900">{{ Auth::user()->email ?? '-' }}</p>
                        </div>
                        <div class="bg-slate-50/80 p-5 rounded-2xl border border-slate-200">
                            <span class="text-[10px] text-slate-400 uppercase tracking-wider font-bold block mb-1">Tanggal Bergabung Sistem</span>
                            <p class="text-sm font-extrabold text-slate-900">{{ Auth::user()->created_at ? Auth::user()->created_at->format('d F Y') : '-' }}</p>
                        </div>
                        <div class="bg-slate-50/80 p-5 rounded-2xl border border-slate-200">
                            <span class="text-[10px] text-slate-400 uppercase tracking-wider font-bold block mb-1">Total Pengajuan Permohonan</span>
                            <p class="text-sm font-extrabold text-slate-900">{{ $totalPermohonan ?? 0 }} Berkas</p>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- Script JavaScript untuk Alur Kerja Tab & Kategori -->
    <script>
        function toggleKategoriFields() {
            const kategori = document.getElementById('kategori_pemohon').value;
            const mahasiswaFields = document.getElementById('mahasiswa-fields');
            const nimInput = document.getElementById('nim');
            const prodiInput = document.getElementById('prodi');
            const fakultasInput = document.getElementById('fakultas');

            if (kategori === 'mahasiswa') {
                mahasiswaFields.style.display = 'block';
                nimInput.setAttribute('required', 'required');
                prodiInput.setAttribute('required', 'required');
                fakultasInput.setAttribute('required', 'required');
            } else {
                mahasiswaFields.style.display = 'none';
                nimInput.removeAttribute('required');
                prodiInput.removeAttribute('required');
                fakultasInput.removeAttribute('required');
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            toggleKategoriFields();
        });

        function toggleTab(tab) {
            const formTab = document.getElementById('tab-content-form');
            const statusTab = document.getElementById('tab-content-status');
            const profileTab = document.getElementById('tab-content-profile');
            
            const btnForm = document.getElementById('btn-tab-form');
            const btnStatus = document.getElementById('btn-tab-status');
            const btnProfile = document.getElementById('btn-tab-profile');

            if (formTab) formTab.style.display = 'none';
            if (statusTab) statusTab.style.display = 'none';
            if (profileTab) profileTab.style.display = 'none';

            [btnForm, btnStatus, btnProfile].forEach(btn => {
                if (btn) {
                    btn.className = "nav-tab-btn w-full flex items-center gap-3 px-4 py-3.5 rounded-2xl text-xs font-semibold text-emerald-200 hover:bg-white/5 hover:text-white transition-all cursor-pointer border border-transparent";
                }
            });

            if (tab === 'form') {
                if (formTab) formTab.style.display = 'block';
                if (btnForm) btnForm.className = "nav-tab-btn active w-full flex items-center gap-3 px-4 py-3.5 rounded-2xl text-xs font-bold bg-gradient-to-r from-emerald-800 to-teal-800 text-white shadow-lg shadow-emerald-950/50 transition-all cursor-pointer border border-emerald-600/30";
            } else if (tab === 'status') {
                if (statusTab) statusTab.style.display = 'block';
                if (btnStatus) btnStatus.className = "nav-tab-btn active w-full flex items-center gap-3 px-4 py-3.5 rounded-2xl text-xs font-bold bg-gradient-to-r from-emerald-800 to-teal-800 text-white shadow-lg shadow-emerald-950/50 transition-all cursor-pointer border border-emerald-600/30";
            } else if (tab === 'profile') {
                if (profileTab) profileTab.style.display = 'block';
                if (btnProfile) btnProfile.className = "nav-tab-btn active w-full flex items-center gap-3 px-4 py-3.5 rounded-2xl text-xs font-bold bg-gradient-to-r from-emerald-800 to-teal-800 text-white shadow-lg shadow-emerald-950/50 transition-all cursor-pointer border border-emerald-600/30";
            }
        }
    </script>
</body>
</html>