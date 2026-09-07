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
<body class="bg-gradient-to-br from-slate-50 via-emerald-50/30 to-teal-50/20 text-slate-800 antialiased min-h-screen flex flex-col">

    <!-- WRAPPER UTAMA: Mengunci lebar minimal 1200px agar konsisten di HP dan Laptop -->
    <div class="w-full overflow-x-auto flex-1 flex">
        <div class="min-w-[1200px] flex-1 flex flex-row">

            <!-- SIDEBAR / NAVBAR PROFESIONAL KIRI (RAMAI & MODERN) -->
            <aside class="w-72 bg-gradient-to-b from-emerald-950 via-teal-900 to-slate-900 text-white flex flex-col justify-between shadow-2xl shrink-0 border-r border-emerald-700/30 min-h-screen">
                <div>
                    <!-- Brand Header -->
                    <div class="p-6 border-b border-emerald-700/30 bg-emerald-900/40 backdrop-blur-md flex flex-col items-center text-center">
                        <div class="bg-gradient-to-tr from-white to-emerald-50 p-3.5 rounded-2xl shadow-xl border border-emerald-200/20 mb-3 transform hover:scale-105 transition-transform duration-300">
                            <img src="{{ asset('images/logo_bksda.png') }}" alt="Logo BKSDA" class="h-14 w-auto object-contain">
                        </div>
                        <div>
                            <h2 class="font-black text-xs tracking-wider text-white leading-tight">BKSDA SULAWESI TENGAH</h2>
                            <span class="text-[10px] bg-gradient-to-r from-amber-400 to-orange-400 text-emerald-950 font-extrabold px-2.5 py-0.5 rounded-full uppercase tracking-widest mt-1.5 inline-block shadow-sm">SIPAKAR System</span>
                        </div>
                    </div>

                    <!-- Menu Navigasi Samping (Tab Trigger) -->
                    <div class="p-4 space-y-2.5 mt-3">
                        <p class="px-3 text-[10px] font-extrabold text-emerald-400 uppercase tracking-widest mb-1">Navigasi Utama</p>
                        
                        <button class="nav-tab-btn active w-full flex items-center gap-3 px-4 py-3.5 rounded-2xl text-xs font-bold bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-lg shadow-emerald-900/40 transition-all cursor-pointer border border-emerald-400/30" id="btn-tab-form" onclick="toggleTab('form')">
                            <div class="w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center text-amber-300 shadow-inner"><i class="fa-solid fa-file-pen"></i></div>
                            <span class="text-left flex-1">Form Pengajuan Baru</span>
                            <i class="fa-solid fa-chevron-right text-[10px] text-emerald-200"></i>
                        </button>

                        <button class="nav-tab-btn w-full flex items-center gap-3 px-4 py-3.5 rounded-2xl text-xs font-semibold text-emerald-200 hover:bg-white/10 hover:text-white transition-all cursor-pointer border border-transparent" id="btn-tab-status" onclick="toggleTab('status')">
                            <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center text-teal-300"><i class="fa-solid fa-list-check"></i></div>
                            <span class="text-left flex-1">Status & Permohonan</span>
                            <span class="bg-gradient-to-r from-amber-400 to-amber-500 text-emerald-950 font-black px-2 py-0.5 rounded-full text-[10px] shadow-sm">{{ $totalPermohonan ?? 0 }}</span>
                        </button>

                        <button class="nav-tab-btn w-full flex items-center gap-3 px-4 py-3.5 rounded-2xl text-xs font-semibold text-emerald-200 hover:bg-white/10 hover:text-white transition-all cursor-pointer border border-transparent" id="btn-tab-profile" onclick="toggleTab('profile')">
                            <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center text-emerald-300"><i class="fa-solid fa-user-gear"></i></div>
                            <span class="text-left flex-1">Profil Saya</span>
                        </button>
                    </div>
                </div>

                <!-- Profil User & Logout di Bagian Bawah Sidebar -->
                <div class="p-4 m-4 bg-emerald-900/60 backdrop-blur-md rounded-2xl border border-emerald-700/40 shadow-xl">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-400 to-orange-500 flex items-center justify-center text-emerald-950 font-extrabold shadow-md">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-[9px] text-emerald-300 uppercase tracking-wider font-bold">Masuk Sebagai</p>
                            <p class="text-xs font-extrabold text-white truncate">{{ Auth::user()->name ?? 'Hadynata Yusuf Pratama' }}</p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-red-500/20 hover:bg-red-600 text-red-200 hover:text-white border border-red-500/30 py-2.5 rounded-xl text-xs font-bold flex items-center justify-center gap-2 transition-all cursor-pointer">
                            <i class="fa-solid fa-right-from-bracket"></i> Keluar Sistem
                        </button>
                    </form>
                </div>
            </aside>

            <!-- KONTEN UTAMA DASHBOARD -->
            <main class="flex-1 p-8 overflow-y-auto">

                <!-- Top Header Page Info -->
                <div class="flex justify-between items-center flex-wrap gap-4 mb-8 bg-gradient-to-r from-white via-emerald-50/40 to-teal-50/30 p-6 rounded-3xl shadow-md border border-emerald-100/80">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="bg-emerald-600 text-white font-extrabold px-3 py-0.5 rounded-full text-[10px] uppercase tracking-wider shadow-sm">Dashboard Layanan</span>
                            <span class="text-slate-400 text-xs font-semibold">/ SIPAKAR BKSDA Sulteng</span>
                        </div>
                        <h1 class="text-2xl font-black text-slate-900 tracking-tight">Sistem Perizinan Akses Kawasan Konservasi</h1>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="px-4 py-2.5 bg-white border border-emerald-200 rounded-2xl flex items-center gap-2 text-xs font-extrabold text-emerald-800 shadow-sm">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span> Status Akun: Aktif & Terverifikasi
                        </div>
                    </div>
                </div>

                <!-- Notifikasi Pesan Sukses / Error -->
                @if(session('success'))
                    <div class="bg-emerald-500 text-white p-4 rounded-2xl mb-8 flex items-center gap-4 text-sm font-semibold shadow-xl shadow-emerald-500/20 border border-emerald-400">
                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-circle-check text-xl"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-white">Berhasil!</h5>
                            <p class="text-xs text-emerald-100">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-600 text-white p-5 rounded-2xl mb-8 shadow-xl shadow-red-600/20 text-sm border border-red-500">
                        <div class="font-bold flex items-center gap-2 mb-2">
                            <i class="fa-solid fa-triangle-exclamation text-lg"></i> Perhatian: Terdapat kesalahan pengisian formulir
                        </div>
                        <ul class="list-disc pl-5 space-y-1 text-xs text-red-100">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- KARTU STATISTIK (DIPERBARUI: WARNA BERBEDA & ADA LOGO CENTANG PADA PERMOHONAN DISETUJUI) -->
                <div class="grid grid-cols-3 gap-6 mb-8">
                    <!-- Stat 1: Pending / Menunggu (Nuansa Amber/Oranye) -->
                    <div class="bg-gradient-to-br from-amber-500 via-amber-600 to-orange-600 p-6 rounded-3xl text-white shadow-xl shadow-amber-600/20 flex items-center justify-between relative overflow-hidden group border border-amber-400/40">
                        <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-white/10 rounded-full group-hover:scale-125 transition-transform"></div>
                        <div>
                            <p class="text-[11px] font-black text-amber-100 uppercase tracking-widest mb-1">Dalam Proses Verifikasi</p>
                            <h4 class="text-3xl font-black text-white">{{ $totalPending ?? 0 }} <span class="text-xs font-medium text-amber-200">Berkas</span></h4>
                            <p class="text-[11px] text-amber-100 mt-1 flex items-center gap-1 font-semibold"><i class="fa-solid fa-clock-rotate-left"></i> Menunggu tinjauan admin</p>
                        </div>
                        <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-2xl shadow-lg border border-white/30 text-amber-200">
                            <i class="fa-solid fa-hourglass-half animate-spin"></i>
                        </div>
                    </div>

                    <!-- Stat 2: Disetujui (Nuansa Emerald/Teal + Logo Centang / Checkmark) -->
                    <div class="bg-gradient-to-br from-emerald-600 via-teal-600 to-cyan-700 p-6 rounded-3xl text-white shadow-xl shadow-teal-600/20 flex items-center justify-between relative overflow-hidden group border border-emerald-400/40">
                        <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-white/10 rounded-full group-hover:scale-125 transition-transform"></div>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <p class="text-[11px] font-black text-emerald-100 uppercase tracking-widest">Permohonan Disetujui</p>
                                <span class="bg-white/20 px-2 py-0.5 rounded-full text-white text-xs shadow-inner flex items-center justify-center">
                                    <i class="fa-solid fa-circle-check text-white"></i>
                                </span>
                            </div>
                            <h4 class="text-3xl font-black text-white">{{ $totalDisetujui ?? 0 }} <span class="text-xs font-medium text-emerald-200">Izin</span></h4>
                            <p class="text-[11px] text-emerald-100 mt-1 flex items-center gap-1 font-semibold"><i class="fa-solid fa-shield-check"></i> Surat izin siap diunduh</p>
                        </div>
                        <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-2xl shadow-lg border border-white/30 text-emerald-200">
                            <i class="fa-solid fa-square-check"></i>
                        </div>
                    </div>

                    <!-- Stat 3: Total (Nuansa Indigo/Blue Modern) -->
                    <div class="bg-gradient-to-br from-indigo-600 via-blue-700 to-teal-800 p-6 rounded-3xl text-white shadow-xl shadow-blue-600/20 flex items-center justify-between relative overflow-hidden group border border-indigo-400/40">
                        <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-white/10 rounded-full group-hover:scale-125 transition-transform"></div>
                        <div>
                            <p class="text-[11px] font-black text-indigo-100 uppercase tracking-widest mb-1">Total Keseluruhan</p>
                            <h4 class="text-3xl font-black text-white">{{ $totalPermohonan ?? 0 }} <span class="text-xs font-medium text-indigo-200">Total</span></h4>
                            <p class="text-[11px] text-indigo-100 mt-1 flex items-center gap-1 font-semibold"><i class="fa-solid fa-folder-tree"></i> Arsip permohonan Anda</p>
                        </div>
                        <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-2xl shadow-lg border border-white/30 text-indigo-200">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                    </div>
                </div>

                <!-- SECTION TAB 1: FORMULIR PENGAJUAN BARU -->
                <div id="tab-content-form" class="bg-white rounded-3xl shadow-2xl shadow-slate-200 border border-slate-200 overflow-hidden mb-12">
                    <div class="bg-gradient-to-r from-emerald-900 via-teal-900 to-slate-900 text-white px-8 py-6 flex items-center justify-between flex-wrap gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-white/15 flex items-center justify-center border border-white/20 text-emerald-300 text-lg">
                                <i class="fa-solid fa-file-pen"></i>
                            </div>
                            <div>
                                <h3 class="font-extrabold text-lg tracking-wide">Formulir SIPAKAR (Sistem Perizinan Akses Kawasan)</h3>
                                <p class="text-xs text-emerald-200">Lengkapi data permohonan izin masuk kawasan konservasi di bawah ini dengan benar[cite: 3].</p>
                            </div>
                        </div>
                        <span class="bg-gradient-to-r from-amber-400 to-orange-400 text-emerald-950 border border-amber-200 text-xs px-3.5 py-1.5 rounded-full font-extrabold shadow-md">
                            <i class="fa-solid fa-asterisk text-[9px] mr-1"></i> Wajib Diisi
                        </span>
                    </div>

                    <div class="p-10">
                        <form action="{{ route('simaksi.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- 1. Data Identitas Pemohon -->
                            <div class="mb-10">
                                <div class="flex items-center gap-3 border-b-2 border-emerald-100 pb-3 mb-6">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-700 text-white flex items-center justify-center font-bold text-xs shadow-md">
                                        <i class="fa-solid fa-id-card"></i>
                                    </div>
                                    <h4 class="text-sm font-black text-emerald-950 uppercase tracking-wider">1. Data Identitas Pemohon</h4>
                                </div>

                                <div class="grid grid-cols-2 gap-6">
                                    <div class="flex flex-col gap-2 col-span-2">
                                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Kategori Pemohon <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <select name="kategori_pemohon" id="kategori_pemohon" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-300 rounded-2xl text-sm font-semibold outline-none focus:ring-2 focus:ring-emerald-700 focus:bg-white transition-all appearance-none cursor-pointer" required onchange="toggleKategoriFields()">
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
                                        <div class="grid grid-cols-2 gap-6 p-6 bg-gradient-to-br from-emerald-50/80 to-teal-50/50 rounded-2xl border border-emerald-200 mb-2 shadow-inner">
                                            <div class="flex flex-col gap-2">
                                                <label class="text-xs font-bold text-emerald-950 uppercase tracking-wider">NIM (Nomor Induk Mahasiswa) <span class="text-red-500">*</span></label>
                                                <input type="text" name="nim" id="nim" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-700 transition-all font-semibold" value="{{ old('nim') }}" placeholder="Masukkan NIM">
                                            </div>
                                            <div class="flex flex-col gap-2">
                                                <label class="text-xs font-bold text-emerald-950 uppercase tracking-wider">Program Studi (Prodi) <span class="text-red-500">*</span></label>
                                                <input type="text" name="prodi" id="prodi" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-700 transition-all font-semibold" value="{{ old('prodi') }}" placeholder="Masukkan Program Studi">
                                            </div>
                                            <div class="flex flex-col gap-2 col-span-2">
                                                <label class="text-xs font-bold text-emerald-950 uppercase tracking-wider">Fakultas <span class="text-red-500">*</span></label>
                                                <input type="text" name="fakultas" id="fakultas" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm outline-none focus:ring-2 focus:ring-emerald-700 transition-all font-semibold" value="{{ old('fakultas') }}" placeholder="Masukkan Fakultas">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Lengkap <span class="text-red-500">*</span></label>
                                        <input type="text" name="nama_lengkap" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-300 rounded-2xl text-sm font-semibold outline-none focus:ring-2 focus:ring-emerald-700 focus:bg-white transition-all" value="{{ Auth::user()->name ?? '' }}" required placeholder="Nama lengkap beserta gelar">
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">NIK / NIP <span class="text-red-500">*</span></label>
                                        <input type="text" name="nik_nip" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-300 rounded-2xl text-sm font-semibold outline-none focus:ring-2 focus:ring-emerald-700 focus:bg-white transition-all" required placeholder="Nomor Induk Kependudukan / NIP">
                                    </div>

                                    <div class="flex flex-col gap-2 col-span-2">
                                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Alamat Lengkap <span class="text-red-500">*</span></label>
                                        <textarea name="alamat" rows="2" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-300 rounded-2xl text-sm font-semibold outline-none focus:ring-2 focus:ring-emerald-700 focus:bg-white transition-all resize-y" required placeholder="Alamat domisili saat ini"></textarea>
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Tempat Lahir <span class="text-red-500">*</span></label>
                                        <input type="text" name="tempat_lahir" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-300 rounded-2xl text-sm font-semibold outline-none focus:ring-2 focus:ring-emerald-700 focus:bg-white transition-all" required placeholder="Kota kelahiran">
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Tanggal Lahir <span class="text-red-500">*</span></label>
                                        <input type="date" name="tanggal_lahir" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-300 rounded-2xl text-sm font-semibold outline-none focus:ring-2 focus:ring-emerald-700 focus:bg-white transition-all" required>
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Nomor WhatsApp / HP Aktif <span class="text-red-500">*</span></label>
                                        <input type="text" name="no_hp" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-300 rounded-2xl text-sm font-semibold outline-none focus:ring-2 focus:ring-emerald-700 focus:bg-white transition-all" required placeholder="Contoh: 081234567890">
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Asal Instansi / Universitas <span class="text-red-500">*</span></label>
                                        <input type="text" name="asal_instansi" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-300 rounded-2xl text-sm font-semibold outline-none focus:ring-2 focus:ring-emerald-700 focus:bg-white transition-all" required placeholder="Contoh: Universitas Tadulako">
                                    </div>
                                </div>
                            </div>

                            <!-- 2. Detail Kegiatan / Penelitian -->
                            <div class="mb-10">
                                <div class="flex items-center gap-3 border-b-2 border-emerald-100 pb-3 mb-6">
                                    <div class="w-8 h-8 rounded-lg bg-teal-700 text-white flex items-center justify-center font-bold text-xs shadow-md">
                                        <i class="fa-solid fa-compass"></i>
                                    </div>
                                    <h4 class="text-sm font-black text-emerald-950 uppercase tracking-wider">2. Detail Kegiatan / Penelitian</h4>
                                </div>

                                <div class="grid grid-cols-2 gap-6">
                                    <div class="flex flex-col gap-2 col-span-2">
                                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Judul Penelitian / Kegiatan <span class="text-red-500">*</span></label>
                                        <input type="text" name="judul_penelitian" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-300 rounded-2xl text-sm font-semibold outline-none focus:ring-2 focus:ring-emerald-700 focus:bg-white transition-all" required placeholder="Judul lengkap penelitian atau kegiatan lapangan">
                                    </div>

                                    <div class="flex flex-col gap-2 col-span-2">
                                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Tujuan Kegiatan <span class="text-red-500">*</span></label>
                                        <textarea name="tujuan_kegiatan" rows="3" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-300 rounded-2xl text-sm font-semibold outline-none focus:ring-2 focus:ring-emerald-700 focus:bg-white transition-all resize-y" required placeholder="Jelaskan tujuan pelaksanaan kegiatan secara ringkas..."></textarea>
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Tanggal Mulai <span class="text-red-500">*</span></label>
                                        <input type="date" name="tanggal_mulai" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-300 rounded-2xl text-sm font-semibold outline-none focus:ring-2 focus:ring-emerald-700 focus:bg-white transition-all" required>
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Tanggal Selesai <span class="text-red-500">*</span></label>
                                        <input type="date" name="tanggal_selesai" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-300 rounded-2xl text-sm font-semibold outline-none focus:ring-2 focus:ring-emerald-700 focus:bg-white transition-all" required>
                                    </div>

                                    <div class="flex flex-col gap-2 col-span-2">
                                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">Lokasi Kawasan Konservasi BKSDA Sulteng <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <select name="lokasi_penelitian" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-300 rounded-2xl text-sm font-semibold outline-none focus:ring-2 focus:ring-emerald-700 focus:bg-white transition-all appearance-none cursor-pointer" required>
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
                                <div class="flex items-center gap-3 border-b-2 border-emerald-100 pb-3 mb-6">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-800 text-white flex items-center justify-center font-bold text-xs shadow-md">
                                        <i class="fa-solid fa-file-arrow-up"></i>
                                    </div>
                                    <h4 class="text-sm font-black text-emerald-950 uppercase tracking-wider">3. Berkas Persyaratan Lampiran</h4>
                                </div>

                                <div class="grid grid-cols-3 gap-6">
                                    <div class="bg-gradient-to-br from-slate-50 to-emerald-50/30 border-2 border-dashed border-slate-300 p-5 rounded-2xl transition-all hover:border-emerald-600 hover:shadow-md group">
                                        <div class="flex flex-col gap-2">
                                            <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-emerald-700 shadow-sm group-hover:bg-emerald-700 group-hover:text-white transition-colors">
                                                <i class="fa-solid fa-id-card"></i>
                                            </div>
                                            <label class="text-xs font-extrabold text-slate-900 mt-1">Scan KTP / Identitas <span class="text-red-500">*</span></label>
                                            <p class="text-[11px] text-slate-500 leading-snug">Format: PDF/JPG/PNG. Maks 5MB.</p>
                                            <input type="file" name="file_ktp" accept=".pdf,.jpg,.jpeg,.png" required class="mt-2 text-xs file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-100 file:text-emerald-900 hover:file:bg-emerald-200 cursor-pointer text-slate-600">
                                        </div>
                                    </div>

                                    <div class="bg-gradient-to-br from-slate-50 to-emerald-50/30 border-2 border-dashed border-slate-300 p-5 rounded-2xl transition-all hover:border-emerald-600 hover:shadow-md group">
                                        <div class="flex flex-col gap-2">
                                            <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-emerald-700 shadow-sm group-hover:bg-emerald-700 group-hover:text-white transition-colors">
                                                <i class="fa-solid fa-envelope-open-text"></i>
                                            </div>
                                            <label class="text-xs font-extrabold text-slate-900 mt-1">Surat Pengantar <span class="text-red-500">*</span></label>
                                            <p class="text-[11px] text-slate-500 leading-snug">Format: PDF/JPG/PNG. Maks 5MB.</p>
                                            <input type="file" name="file_surat_pengantar" accept=".pdf,.jpg,.jpeg,.png" required class="mt-2 text-xs file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-100 file:text-emerald-900 hover:file:bg-emerald-200 cursor-pointer text-slate-600">
                                        </div>
                                    </div>

                                    <div class="bg-gradient-to-br from-slate-50 to-emerald-50/30 border-2 border-dashed border-slate-300 p-5 rounded-2xl transition-all hover:border-emerald-600 hover:shadow-md group">
                                        <div class="flex flex-col gap-2">
                                            <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-emerald-700 shadow-sm group-hover:bg-emerald-700 group-hover:text-white transition-colors">
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </div>
                                            <label class="text-xs font-extrabold text-slate-900 mt-1">Proposal Kegiatan (PDF) <span class="text-red-500">*</span></label>
                                            <p class="text-[11px] text-slate-500 leading-snug">Format PDF resmi. Maksimal 10 MB.</p>
                                            <input type="file" name="file_proposal" accept=".pdf" required class="mt-2 text-xs file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-100 file:text-emerald-900 hover:file:bg-emerald-200 cursor-pointer text-slate-600">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="flex items-center justify-end pt-4 border-t border-slate-200">
                                <button type="submit" class="bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-800 text-white px-9 py-4 rounded-2xl text-sm font-extrabold tracking-wide shadow-xl shadow-emerald-700/30 hover:shadow-emerald-700/50 hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-3 justify-center cursor-pointer">
                                    <i class="fa-solid fa-paper-plane"></i> Kirim Permohonan SIPAKAR
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- SECTION TAB 2: STATUS & PERMOHONAN DIKIRIM -->
                <div id="tab-content-status" class="bg-white rounded-3xl shadow-2xl shadow-slate-200 border border-slate-200 overflow-hidden mb-12" style="display: none;">
                    <div class="bg-gradient-to-r from-emerald-900 via-teal-900 to-slate-900 text-white px-8 py-6 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-white/15 flex items-center justify-center border border-white/20 text-emerald-300 text-lg">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                            </div>
                            <div>
                                <h3 class="font-extrabold text-lg tracking-wide">Riwayat & Status Permohonan Dikirim</h3>
                                <p class="text-xs text-emerald-200">Pantau proses perizinan lengkap dengan keterangan aksi admin secara real-time.</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse text-left text-sm">
                                <thead>
                                    <tr class="bg-gradient-to-r from-slate-100 to-emerald-50/50 text-slate-700 text-xs uppercase tracking-wider border-b-2 border-slate-200">
                                        <th class="p-4 font-black">No</th>
                                        <th class="p-4 font-black">Pemohon</th>
                                        <th class="p-4 font-black">Judul Kegiatan</th>
                                        <th class="p-4 font-black">Lokasi Kawasan</th>
                                        <th class="p-4 font-black">Tanggal</th>
                                        <th class="p-4 font-black">Status Aksi Admin</th>
                                        <th class="p-4 font-black">Catatan & Jadwal Zoom</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($permohonan ?? [] as $index => $item)
                                    <tr class="hover:bg-slate-50/80 transition-all">
                                        <td class="p-4 text-slate-600 font-bold">{{ $index + 1 }}</td>
                                        <td class="p-4 text-slate-700">
                                            <strong class="text-slate-900 block font-extrabold">{{ $item->nama_lengkap }}</strong>
                                            <span class="text-xs text-slate-500 font-medium">{{ $item->asal_instansi }}</span>
                                        </td>
                                        <td class="p-4 text-slate-700 font-semibold">{{ $item->judul_penelitian }}</td>
                                        <td class="p-4"><span class="bg-emerald-50 text-emerald-800 px-3 py-1 rounded-xl text-xs font-bold border border-emerald-200 shadow-sm">{{ $item->lokasi_penelitian }}</span></td>
                                        <td class="p-4 text-slate-600 text-xs font-semibold">{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</td>
                                        
                                        <!-- KOLOM STATUS AKSI ADMIN -->
                                        <td class="p-4">
                                            @php 
                                                $status = strtolower(trim($item->status ?? 'pending')); 
                                            @endphp

                                            @if($status == 'pending')
                                                <div class="flex flex-col gap-1.5 items-start">
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-amber-100 text-amber-900 border border-amber-300 shadow-sm">
                                                        <i class="fa-solid fa-spinner fa-spin text-amber-600"></i> Menunggu Verifikasi
                                                    </span>
                                                    <span class="text-[10px] text-slate-500 italic">Berkas sedang diperiksa admin</span>
                                                </div>
                                            @elseif($status == 'menunggu zoom')
                                                <div class="flex flex-col gap-1.5 items-start">
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-blue-100 text-blue-900 border border-blue-300 shadow-sm">
                                                        <i class="fa-solid fa-video text-blue-600"></i> Menunggu Zoom
                                                    </span>
                                                    <span class="text-[10px] text-blue-700 font-semibold">Admin menjadwalkan wawancara/briefing</span>
                                                </div>
                                            @elseif($status == 'disetujui')
                                                <div class="flex flex-col gap-2 items-start">
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-emerald-100 text-emerald-900 border border-emerald-300 shadow-sm">
                                                        <i class="fa-solid fa-circle-check text-emerald-600"></i> Disetujui
                                                    </span>
                                                    <span class="text-[10px] text-emerald-700 font-semibold">Permohonan izin diberikan</span>
                                                    @if(!empty($item->surat_izin))
                                                        <a href="{{ route('simaksi.downloadPdf', $item->id) }}" class="inline-flex items-center gap-1.5 bg-gradient-to-r from-teal-600 to-emerald-700 hover:from-teal-700 hover:to-emerald-800 text-white px-3 py-1.5 rounded-xl text-xs font-extrabold shadow-md transition-all" target="_blank">
                                                            <i class="fa-solid fa-file-pdf"></i> Unduh Surat Izin
                                                        </a>
                                                    @endif
                                                </div>
                                            @elseif($status == 'ditolak')
                                                <div class="flex flex-col gap-1.5 items-start">
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-red-100 text-red-900 border border-red-300 shadow-sm">
                                                        <i class="fa-solid fa-circle-xmark text-red-600"></i> Ditolak
                                                    </span>
                                                    <span class="text-[10px] text-red-700 font-semibold">Permohonan tidak memenuhi syarat</span>
                                                </div>
                                            @elseif($status == 'dihapus' || $status == 'permohonan dihapus')
                                                <div class="flex flex-col gap-1.5 items-start">
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-slate-200 text-slate-800 border border-slate-300 shadow-sm">
                                                        <i class="fa-solid fa-trash-can text-slate-600"></i> Permohonan Dihapus
                                                    </span>
                                                    <span class="text-[10px] text-slate-600 font-semibold">Berkas dihapus oleh sistem/admin</span>
                                                </div>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                                    {{ ucfirst($status) }}
                                                </span>
                                            @endif
                                        </td>

                                        <!-- KOLOM CATATAN ADMIN & LINK ZOOM -->
                                        <td class="p-4 text-slate-600 text-xs">
                                            @if(!empty($item->catatan_admin))
                                                <div class="mb-2.5 p-3 bg-amber-50 border border-amber-200 rounded-2xl text-amber-900 shadow-sm">
                                                    <span class="font-extrabold block text-[10px] uppercase text-amber-800 mb-0.5"><i class="fa-solid fa-comment-dots mr-1 text-amber-600"></i> Keterangan / Catatan Admin:</span>
                                                    <p class="text-xs font-semibold leading-relaxed">{{ $item->catatan_admin }}</p>
                                                </div>
                                            @endif

                                            @if(!empty($item->link_zoom) || !empty($item->tanggal_zoom))
                                                <div class="p-3 bg-teal-50 border border-teal-200 rounded-2xl text-teal-900 shadow-sm">
                                                    <span class="font-extrabold block text-[10px] uppercase text-teal-800 mb-1"><i class="fa-solid fa-video mr-1 text-teal-600"></i> Jadwal & Link Zoom:</span>
                                                    <span class="font-bold block mb-1.5 text-slate-700"><i class="fa-regular fa-calendar text-emerald-700 mr-1"></i>{{ $item->tanggal_zoom ?? 'Jadwal menyusul' }}</span>
                                                    @if(!empty($item->link_zoom))
                                                        <a href="{{ $item->link_zoom }}" target="_blank" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold inline-flex items-center gap-1.5 shadow-sm text-xs transition-all"><i class="fa-solid fa-arrow-up-right-from-square"></i> Gabung Zoom Meeting</a>
                                                    @endif
                                                </div>
                                            @else
                                                @if(empty($item->catatan_admin))
                                                    <span class="text-slate-400 italic font-medium">Belum ada keterangan atau jadwal dari admin.</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-16 text-slate-400">
                                            <div class="w-16 h-16 bg-slate-100 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-3 text-2xl shadow-inner">
                                                <i class="fa-solid fa-folder-open"></i>
                                            </div>
                                            <p class="font-bold text-slate-600 text-sm">Belum ada permohonan yang dikirim.</p>
                                            <p class="text-xs text-slate-400 mt-1">Silakan buat pengajuan baru melalui tab menu sebelah kiri.</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- SECTION TAB 3: PROFIL SAYA -->
                <div id="tab-content-profile" class="bg-white rounded-3xl shadow-2xl shadow-slate-200 border border-slate-200 overflow-hidden mb-12" style="display: none;">
                    <div class="bg-gradient-to-r from-emerald-900 via-teal-900 to-slate-900 text-white px-8 py-6 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-white/15 flex items-center justify-center border border-white/20 text-emerald-300 text-lg">
                                <i class="fa-solid fa-id-card-clip"></i>
                            </div>
                            <div>
                                <h3 class="font-extrabold text-lg tracking-wide">Profil Akun Pemohon</h3>
                                <p class="text-xs text-emerald-200">Informasi detail mengenai akun Anda yang terdaftar pada sistem[cite: 3].</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-10">
                        <div class="flex items-center gap-6 bg-gradient-to-r from-emerald-50 via-teal-50/50 to-white p-8 rounded-3xl mb-8 border border-emerald-200 shadow-md">
                            <div class="w-20 h-20 bg-gradient-to-tr from-emerald-700 to-teal-700 text-white rounded-2xl flex items-center justify-center text-3xl shadow-xl shrink-0 border-2 border-white">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                            <div>
                                <span class="bg-gradient-to-r from-emerald-700 to-teal-700 text-white text-[10px] font-extrabold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">Terverifikasi BKSDA</span>
                                <h3 class="text-2xl font-black text-emerald-950 mt-1">{{ Auth::user()->name ?? 'Hadynata Yusuf Pratama' }}</h3>
                                <p class="text-xs text-slate-600 mt-1 flex items-center gap-2 font-semibold">
                                    <i class="fa-solid fa-envelope text-emerald-700"></i> {{ Auth::user()->email ?? 'hadynata@student.id' }}
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 shadow-sm">
                                <span class="text-[10px] text-slate-400 uppercase tracking-wider font-extrabold block mb-1">Nama Pengguna</span>
                                <p class="text-sm font-black text-slate-900">{{ Auth::user()->name ?? '-' }}</p>
                            </div>
                            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 shadow-sm">
                                <span class="text-[10px] text-slate-400 uppercase tracking-wider font-extrabold block mb-1">Alamat Email</span>
                                <p class="text-sm font-black text-slate-900">{{ Auth::user()->email ?? '-' }}</p>
                            </div>
                            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 shadow-sm">
                                <span class="text-[10px] text-slate-400 uppercase tracking-wider font-extrabold block mb-1">Tanggal Bergabung Sistem</span>
                                <p class="text-sm font-black text-slate-900">{{ Auth::user()->created_at ? Auth::user()->created_at->format('d F Y') : '-' }}</p>
                            </div>
                            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 shadow-sm">
                                <span class="text-[10px] text-slate-400 uppercase tracking-wider font-extrabold block mb-1">Total Pengajuan Permohonan</span>
                                <p class="text-sm font-black text-slate-900">{{ $totalPermohonan ?? 0 }} Berkas</p>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
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
                    btn.className = "nav-tab-btn w-full flex items-center gap-3 px-4 py-3.5 rounded-2xl text-xs font-semibold text-emerald-200 hover:bg-white/10 hover:text-white transition-all cursor-pointer border border-transparent";
                }
            });

            if (tab === 'form') {
                if (formTab) formTab.style.display = 'block';
                if (btnForm) btnForm.className = "nav-tab-btn active w-full flex items-center gap-3 px-4 py-3.5 rounded-2xl text-xs font-bold bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-lg shadow-emerald-900/40 transition-all cursor-pointer border border-emerald-400/30";
            } else if (tab === 'status') {
                if (statusTab) statusTab.style.display = 'block';
                if (btnStatus) btnStatus.className = "nav-tab-btn active w-full flex items-center gap-3 px-4 py-3.5 rounded-2xl text-xs font-bold bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-lg shadow-emerald-900/40 transition-all cursor-pointer border border-emerald-400/30";
            } else if (tab === 'profile') {
                if (profileTab) profileTab.style.display = 'block';
                if (btnProfile) btnProfile.className = "nav-tab-btn active w-full flex items-center gap-3 px-4 py-3.5 rounded-2xl text-xs font-bold bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-lg shadow-emerald-900/40 transition-all cursor-pointer border border-emerald-400/30";
            }
        }
    </script>
</body>
</html>