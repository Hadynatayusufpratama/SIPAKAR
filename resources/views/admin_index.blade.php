<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin SIPAKAR - BKSDA Sulteng</title>
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#064e3b',
                        'primary-dark': '#022c22',
                        'primary-light': '#ecfdf5',
                        accent: '#d97706',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50/70 text-slate-800 antialiased min-h-screen flex flex-col">

    <!-- Layout Wrapper (Sidebar + Main Content) -->
    <div class="flex-1 flex flex-col lg:flex-row min-h-screen">

        <!-- Mobile Header Bar -->
        <div class="lg:hidden bg-gradient-to-r from-emerald-950 via-teal-900 to-emerald-900 text-white p-4 flex justify-between items-center border-b-2 border-amber-500 sticky top-0 z-50 shadow-md">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo_bksda.png') }}" alt="Logo BKSDA Sulteng" class="h-9 w-auto object-contain bg-white px-2 py-1 rounded shadow-sm">
                <h2 class="text-xs font-extrabold tracking-wider uppercase">SIPAKAR ADMIN</h2>
            </div>
            <button onclick="toggleSidebar()" class="text-white text-xl focus:outline-none">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <!-- SIDEBAR / NAVBAR PROFESIONAL KIRI -->
        <aside class="w-full lg:w-72 bg-gradient-to-b from-emerald-950 via-teal-950 to-emerald-900 text-white flex flex-col justify-between shadow-2xl shrink-0 border-r border-emerald-800/40">
            <div>
                <!-- Brand Header (Logo di Atas, Teks di Bawah Secara Center) -->
                <div class="p-6 border-b border-emerald-800/60 bg-emerald-950/50 flex flex-col items-center text-center">
                    <div class="bg-white p-3 rounded-2xl shadow-xl border border-amber-500/30 mb-3 transform hover:scale-105 transition-transform duration-300">
                        <img src="{{ asset('images/logo_bksda.png') }}" alt="Logo BKSDA" class="h-16 w-auto object-contain">
                    </div>
                    <div>
                        <h2 class="font-black text-sm tracking-wide text-white leading-tight">BKSDA SULAWESI TENGAH</h2>
                        <span class="text-[11px] text-amber-400 font-bold uppercase tracking-widest mt-1 inline-block">SIPAKAR Online System</span>
                    </div>
                </div>

                <!-- Admin Active Badge & Navigation Info -->
                <div class="p-4 flex-1 overflow-y-auto space-y-6">
                    <div class="bg-emerald-900/30 border border-amber-500/30 rounded-xl p-3 text-center shadow-inner">
                        <span class="inline-flex items-center gap-2 bg-amber-500/20 text-amber-300 border border-amber-500/40 px-3 py-1 rounded-full text-xs font-bold shadow-sm mb-1">
                            <i class="fa-solid fa-circle text-[85%] animate-pulse"></i> Admin Active
                        </span>
                        <p class="text-[10px] text-slate-300 font-medium">Sistem Pengendalian Kawasan Konservasi</p>
                    </div>

                    <!-- Navigasi Utama & Tab Status di Sidebar Kiri -->
                    <div class="space-y-1.5">
                        <p class="text-[10px] font-bold text-amber-400 uppercase tracking-widest px-3 mb-2 flex items-center gap-1.5"><i class="fa-solid fa-filter"></i> Filter Status Permohonan</p>
                        
                        <a href="{{ route('simaksi.admin', ['status' => 'semua', 'kategori' => request('kategori', 'semua')]) }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all {{ ($status ?? 'semua') == 'semua' ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-emerald-950 font-bold shadow-lg shadow-amber-500/20' : 'text-slate-200 hover:bg-emerald-900/50' }}">
                            <span class="flex items-center gap-2.5"><i class="fa-solid fa-list w-4"></i> Semua Permohonan</span>
                            <span class="text-[10px] px-2 py-0.5 rounded-full {{ ($status ?? 'semua') == 'semua' ? 'bg-emerald-950 text-amber-300 font-bold' : 'bg-emerald-900/60 text-slate-300' }}">{{ $countSemua ?? 0 }}</span>
                        </a>

                        <a href="{{ route('simaksi.admin', ['status' => 'pending', 'kategori' => request('kategori', 'semua')]) }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all {{ ($status ?? '') == 'pending' ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-emerald-950 font-bold shadow-lg shadow-amber-500/20' : 'text-slate-200 hover:bg-emerald-900/50' }}">
                            <span class="flex items-center gap-2.5"><i class="fa-solid fa-hourglass-half w-4"></i> Permohonan Masuk</span>
                            <span class="text-[10px] px-2 py-0.5 rounded-full {{ ($status ?? '') == 'pending' ? 'bg-emerald-950 text-amber-300 font-bold' : 'bg-emerald-900/60 text-slate-300' }}">{{ $countPending ?? 0 }}</span>
                        </a>

                        <a href="{{ route('simaksi.admin', ['status' => 'disetujui', 'kategori' => request('kategori', 'semua')]) }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all {{ ($status ?? '') == 'disetujui' ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-emerald-950 font-bold shadow-lg shadow-amber-500/20' : 'text-slate-200 hover:bg-emerald-900/50' }}">
                            <span class="flex items-center gap-2.5"><i class="fa-solid fa-check-circle w-4"></i> Disetujui</span>
                            <span class="text-[10px] px-2 py-0.5 rounded-full {{ ($status ?? '') == 'disetujui' ? 'bg-emerald-950 text-amber-300 font-bold' : 'bg-emerald-900/60 text-slate-300' }}">{{ $countDisetujui ?? 0 }}</span>
                        </a>

                        <a href="{{ route('simaksi.admin', ['status' => 'ditolak', 'kategori' => request('kategori', 'semua')]) }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all {{ ($status ?? '') == 'ditolak' ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-emerald-950 font-bold shadow-lg shadow-amber-500/20' : 'text-slate-200 hover:bg-emerald-900/50' }}">
                            <span class="flex items-center gap-2.5"><i class="fa-solid fa-times-circle w-4"></i> Ditolak</span>
                            <span class="text-[10px] px-2 py-0.5 rounded-full {{ ($status ?? '') == 'ditolak' ? 'bg-emerald-950 text-amber-300 font-bold' : 'bg-emerald-900/60 text-slate-300' }}">{{ $countDitolak ?? 0 }}</span>
                        </a>
                    </div>
                </div>

                <!-- Logout Section at Bottom of Sidebar -->
                <div class="p-4 border-t border-emerald-900/60 bg-emerald-950/90">
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="w-full bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-700 hover:to-red-700 text-white py-2.5 px-4 rounded-xl text-xs font-bold flex items-center justify-center gap-2 shadow-lg shadow-rose-600/20 transition-all">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout Sistem
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Overlay for mobile sidebar -->
        <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden backdrop-blur-sm"></div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0">
            
            <!-- Desktop Topbar Minimalis -->
            <header class="hidden lg:flex bg-white border-b border-slate-200 px-8 py-4 justify-between items-center sticky top-0 z-20 shadow-sm">
                <div class="flex items-center gap-3">
                    <h1 class="text-sm font-extrabold text-emerald-950 tracking-wider uppercase flex items-center gap-2">
                        <span class="w-2 h-5 bg-amber-500 rounded-full"></span> Dashboard Admin SIPAKAR
                    </h1>
                </div>
                <div class="flex items-center gap-4">
                    <span class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-800 border border-emerald-200 px-3 py-1.5 rounded-full text-xs font-bold">
                        <i class="fa-solid fa-circle text-[8px] text-amber-500 animate-pulse"></i> Admin Active
                    </span>

                </div>
            </header>

            <!-- Container Konten Utama -->
            <main class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-1">

                <!-- Alert Notifikasi -->
                @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-400 text-emerald-900 px-5 py-4 rounded-xl mb-7 text-xs font-semibold flex items-center gap-3 shadow-sm">
                        <i class="fa-solid fa-circle-check text-base text-emerald-600"></i> {{ session('success') }}
                    </div>
                @endif

                <!-- Grid Statistik Permohonan -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between relative overflow-hidden group hover:shadow-lg hover:border-emerald-600/30 transition-all">
                        <div class="absolute bottom-0 left-0 w-full h-[3px] bg-gradient-to-r from-emerald-600 to-amber-500 opacity-0 group-hover:opacity-100 transition-all"></div>
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-wider text-emerald-800">Semua Masuk</p>
                            <h3 class="text-2xl font-extrabold text-slate-900 mt-1">{{ $countSemua ?? 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl shadow-inner border border-emerald-100">
                            <i class="fa-solid fa-folder-open"></i>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between relative overflow-hidden group hover:shadow-lg hover:border-amber-500/30 transition-all">
                        <div class="absolute bottom-0 left-0 w-full h-[3px] bg-gradient-to-r from-emerald-600 to-amber-500 opacity-0 group-hover:opacity-100 transition-all"></div>
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-wider text-amber-600">Menunggu Persetujuan</p>
                            <h3 class="text-2xl font-extrabold text-slate-900 mt-1">{{ $countPending ?? 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl shadow-inner border border-amber-100">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between relative overflow-hidden group hover:shadow-lg hover:border-emerald-600/30 transition-all">
                        <div class="absolute bottom-0 left-0 w-full h-[3px] bg-gradient-to-r from-emerald-600 to-amber-500 opacity-0 group-hover:opacity-100 transition-all"></div>
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-wider text-emerald-600">Disetujui</p>
                            <h3 class="text-2xl font-extrabold text-slate-900 mt-1">{{ $countDisetujui ?? 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shadow-inner border border-emerald-100">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between relative overflow-hidden group hover:shadow-lg hover:border-rose-500/30 transition-all">
                        <div class="absolute bottom-0 left-0 w-full h-[3px] bg-gradient-to-r from-emerald-600 to-amber-500 opacity-0 group-hover:opacity-100 transition-all"></div>
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-wider text-rose-600">Ditolak</p>
                            <h3 class="text-2xl font-extrabold text-slate-900 mt-1">{{ $countDitolak ?? 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl shadow-inner border border-rose-100">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </div>
                    </div>
                </div>

                <!-- Sub-Pilihan Kategori (Mahasiswa / Umum) -->
                <div class="mb-6 flex flex-wrap gap-2.5 items-center">
                    <span class="text-xs font-bold text-slate-600 flex items-center gap-1.5"><i class="fa-solid fa-filter text-amber-600"></i> Kategori:</span>
                    <a href="{{ route('simaksi.admin', ['status' => request('status', 'semua'), 'kategori' => 'semua']) }}" 
                       class="px-3.5 py-1.5 rounded-full text-xs font-bold transition-all {{ (request('kategori', 'semua') == 'semua') ? 'bg-gradient-to-r from-emerald-900 to-teal-900 text-white shadow-md shadow-emerald-900/20' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-100' }}">
                        Semua Kategori
                    </a>
                    <a href="{{ route('simaksi.admin', ['status' => request('status', 'semua'), 'kategori' => 'mahasiswa']) }}" 
                       class="px-3.5 py-1.5 rounded-full text-xs font-bold transition-all {{ (request('kategori') == 'mahasiswa') ? 'bg-gradient-to-r from-emerald-900 to-teal-900 text-white shadow-md shadow-emerald-900/20' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-100' }}">
                        Mahasiswa
                    </a>
                    <a href="{{ route('simaksi.admin', ['status' => request('status', 'semua'), 'kategori' => 'umum']) }}" 
                       class="px-3.5 py-1.5 rounded-full text-xs font-bold transition-all {{ (request('kategori') == 'umum') ? 'bg-gradient-to-r from-emerald-900 to-teal-900 text-white shadow-md shadow-emerald-900/20' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-100' }}">
                        Umum
                    </a>
                </div>

                <!-- Tabel Card Container -->
                <div class="bg-white rounded-2xl shadow-md border border-slate-200 overflow-hidden mb-8">
                    <div class="bg-gradient-to-r from-emerald-950 via-teal-950 to-emerald-900 text-white px-6 py-4 flex justify-between items-center text-sm font-bold border-b border-amber-500/30">
                        <span class="flex items-center gap-2"><i class="fa-solid fa-list-check text-amber-400"></i> Daftar Permohonan SIPAKAR</span>
                        <span class="text-xs font-semibold bg-emerald-900/60 text-amber-300 border border-emerald-700/50 px-3 py-1 rounded-full">Total Tampil: {{ $pendaftarans->count() }} Data</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs">
                            <thead>
                                <tr class="bg-slate-100/70 text-slate-700 uppercase tracking-wider text-[11px] border-b border-slate-200">
                                    <th class="p-4 font-bold">No</th>
                                    <th class="p-4 font-bold">Tanggal Daftar</th>
                                    <th class="p-4 font-bold">Nama & Instansi</th>
                                    <th class="p-4 font-bold">Kontak</th>
                                    <th class="p-4 font-bold">Judul Kegiatan</th>
                                    <th class="p-4 font-bold">Lokasi Kawasan</th>
                                    <th class="p-4 font-bold">Status</th>
                                    <th class="p-4 font-bold">Berkas</th>
                                    <th class="p-4 font-bold text-center">Aksi & Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($pendaftarans as $index => $item)
                                    <tr class="hover:bg-emerald-50/35 transition-colors">
                                        <td class="p-4 font-bold text-slate-700">{{ $index + 1 }}</td>
                                        <td class="p-4 text-slate-600 whitespace-nowrap">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                        <td class="p-4">
                                            <span class="font-bold text-slate-900">{{ $item->nama_lengkap }}</span><br>
                                            <small class="text-slate-500">NIK: {{ $item->nik_nip }}</small><br>
                                            <small class="text-emerald-800 font-semibold">{{ $item->asal_instansi }}</small>

                                            {{-- Tambahan Tampilan Khusus Mahasiswa --}}
                                            @if(strtolower($item->kategori_pemohon) == 'mahasiswa')
                                                <div class="mt-1.5 pt-1.5 border-t border-dashed border-slate-200 text-[11px]">
                                                    <span class="bg-amber-100 text-amber-900 px-1.5 py-0.5 rounded font-bold border border-amber-200">Mahasiswa</span><br>
                                                    <span><b>NIM:</b> {{ $item->nim }}</span><br>
                                                    <span><b>Prodi:</b> {{ $item->prodi }}</span><br>
                                                    <span><b>Fakultas:</b> {{ $item->fakultas }}</span>
                                                </div>
                                            @else
                                                <div class="mt-1">
                                                    <span class="bg-slate-100 text-slate-600 px-1.5 py-0.5 rounded font-bold text-[10px]">Umum</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="p-4 whitespace-nowrap">
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->no_hp) }}" target="_blank" class="text-emerald-700 font-semibold hover:underline inline-flex items-center gap-1">
                                                <i class="fa-brands fa-whatsapp text-emerald-600"></i> {{ $item->no_hp }}
                                            </a>
                                        </td>
                                        <td class="p-4 max-w-[200px] font-medium text-slate-800">
                                            {{ $item->judul_penelitian }}
                                        </td>
                                        <td class="p-4 whitespace-nowrap">
                                            <span class="bg-emerald-50 text-emerald-900 px-2.5 py-1 rounded-md text-xs font-semibold border border-emerald-200/60">{{ $item->lokasi_penelitian }}</span>
                                        </td>
                                        <td class="p-4 whitespace-nowrap">
                                            @if($item->status == 'disetujui')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-300 shadow-sm"><i class="fa-solid fa-circle-check text-emerald-600"></i> Disetujui</span>
                                            @elseif($item->status == 'menunggu_zoom')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-sky-50 text-sky-800 border border-sky-300 shadow-sm"><i class="fa-solid fa-video text-sky-600"></i> Menunggu Zoom</span>
                                            @elseif($item->status == 'ditolak')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-rose-50 text-rose-800 border border-rose-300 shadow-sm"><i class="fa-solid fa-circle-xmark text-rose-600"></i> Ditolak</span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-amber-50 text-amber-900 border border-amber-300 shadow-sm"><i class="fa-solid fa-clock text-amber-600"></i> Menunggu</span>
                                            @endif
                                        </td>
                                        <td class="p-4 whitespace-nowrap space-y-1">
                                            @if($item->file_ktp)
                                                <a href="{{ asset('storage/' . $item->file_ktp) }}" target="_blank" class="inline-flex items-center gap-1 px-2.5 py-1 bg-sky-600 hover:bg-sky-700 text-white rounded text-[11px] font-semibold shadow-sm transition-all"><i class="fa-solid fa-id-card"></i> KTP</a><br>
                                            @endif
                                            @if($item->file_surat_pengantar)
                                                <a href="{{ asset('storage/' . $item->file_surat_pengantar) }}" target="_blank" class="inline-flex items-center gap-1 px-2.5 py-1 bg-sky-600 hover:bg-sky-700 text-white rounded text-[11px] font-semibold shadow-sm transition-all"><i class="fa-solid fa-envelope"></i> Surat</a><br>
                                            @endif
                                            @if($item->file_proposal)
                                                <a href="{{ asset('storage/' . $item->file_proposal) }}" target="_blank" class="inline-flex items-center gap-1 px-2.5 py-1 bg-rose-600 hover:bg-rose-700 text-white rounded text-[11px] font-semibold shadow-sm transition-all"><i class="fa-solid fa-file-pdf"></i> Proposal</a>
                                            @endif
                                        </td>
                                        <td class="p-4 text-center align-middle">
                                            <div class="flex flex-col gap-1.5 justify-center w-40 mx-auto">
                                                
                                                <!-- Tombol Lihat Detail Lengkap -->
                                                <button type="button" class="w-full bg-slate-700 hover:bg-slate-800 text-white py-1.5 px-3 rounded text-[11px] font-bold inline-flex items-center justify-center gap-1.5 shadow transition-all" onclick="openModal('modal-{{ $item->id }}')" title="Lihat Formulir Lengkap">
                                                    <i class="fa-solid fa-eye"></i> Detail Lengkap
                                                </button>

                                                <!-- 1. Form Jadwal Zoom -->
                                                <form action="{{ route('admin.simaksi.updateStatus', $item->id) }}" method="POST" class="border border-dashed border-sky-400 p-2 rounded bg-sky-50/70 text-left w-full m-0 space-y-1.5">
                                                    @csrf 
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="menunggu_zoom">
                                                    <label class="text-[10px] font-bold text-sky-800 block">Jadwalkan Zoom:</label>
                                                    <input type="datetime-local" name="tanggal_zoom" class="w-full p-1.5 text-[11px] border border-slate-300 rounded bg-white outline-none focus:border-sky-600" value="{{ $item->tanggal_zoom ? \Carbon\Carbon::parse($item->tanggal_zoom)->format('Y-m-d\TH:i') : '' }}" required>
                                                    <input type="text" name="link_zoom" class="w-full p-1.5 text-[11px] border border-slate-300 rounded bg-white outline-none focus:border-sky-600" placeholder="Link Zoom / Meeting" value="{{ $item->link_zoom }}" required>
                                                    <button type="submit" class="w-full bg-cyan-600 hover:bg-cyan-700 text-white py-1 px-2 rounded text-[10px] font-bold inline-flex items-center justify-center gap-1 shadow-sm transition-all" title="Kirim Jadwal Zoom ke Pemohon">
                                                        <i class="fa-solid fa-video"></i> Kirim Zoom
                                                    </button>
                                                </form>

                                                <!-- 2. Form Setuju -->
                                                @if($item->status != 'disetujui')
                                                    <form action="{{ route('admin.simaksi.updateStatus', $item->id) }}" method="POST" enctype="multipart/form-data" class="border border-dashed border-emerald-500 p-2 rounded bg-emerald-50/70 text-left w-full m-0 space-y-1.5">
                                                        @csrf 
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="disetujui">
                                                        
                                                        <label class="text-[10px] font-bold text-emerald-800 block">Upload Surat Izin (PDF):</label>
                                                        <input type="file" name="surat_izin" class="w-full p-1 text-[10px] border border-slate-300 rounded bg-white" accept=".pdf" required>
                                                        
                                                        <textarea name="catatan_admin" class="w-full p-1.5 text-[11px] border border-slate-300 rounded bg-white outline-none focus:border-emerald-600" placeholder="Catatan/SOP final (opsional)" rows="2">{{ $item->catatan_admin }}</textarea>

                                                        <button type="submit" class="w-full bg-emerald-700 hover:bg-emerald-800 text-white py-1.5 px-2 rounded text-[10px] font-bold inline-flex items-center justify-center gap-1 shadow-sm transition-all" onclick="return confirm('Setujui permohonan ini dan unggah surat izin?')" title="Setujui Permohonan">
                                                            <i class="fa-solid fa-check"></i> Setujui & Kirim
                                                        </button>
                                                    </form>
                                                @endif

                                                <div class="flex gap-1 w-full">
                                                    <!-- 3. Tombol Tolak -->
                                                    @if($item->status != 'ditolak')
                                                        <form action="{{ route('admin.simaksi.updateStatus', $item->id) }}" method="POST" class="m-0 flex-1">
                                                            @csrf @method('PATCH')
                                                            <input type="hidden" name="status" value="ditolak">
                                                            <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white py-1.5 px-2 rounded text-[10px] font-bold inline-flex items-center justify-center gap-1 shadow-sm transition-all" onclick="return confirm('Tolak permohonan ini?')" title="Tolak">
                                                                <i class="fa-solid fa-xmark"></i> Tolak
                                                            </button>
                                                        </form>
                                                    @endif

                                                    <!-- 4. Tombol Hapus Data -->
                                                    <form action="{{ route('admin.simaksi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus permanen permohonan {{ $item->nama_lengkap }}?');" class="m-0 flex-1">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white py-1.5 px-2 rounded text-[10px] font-bold inline-flex items-center justify-center gap-1 shadow-sm transition-all" title="Hapus Data">
                                                            <i class="fa-solid fa-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Popup Modal Detail Formulir Pemohon -->
                                    <div id="modal-{{ $item->id }}" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4">
                                        <div class="bg-white w-full max-w-xl max-h-[90vh] rounded-2xl shadow-2xl overflow-hidden flex flex-col border border-slate-200 animate-in fade-in zoom-in duration-200">
                                            <div class="bg-gradient-to-r from-emerald-950 to-emerald-900 text-white px-6 py-4 flex justify-between items-center font-bold border-b border-amber-500/30">
                                                <h3 class="text-sm flex items-center gap-2"><i class="fa-solid fa-file-lines text-amber-400"></i> Detail Formulir SIMAKSI - {{ $item->nama_lengkap }}</h3>
                                                <button onclick="closeModal('modal-{{ $item->id }}')" class="text-white hover:text-amber-400 text-xl font-bold focus:outline-none">&times;</button>
                                            </div>
                                            <div class="p-6 overflow-y-auto space-y-4 text-xs">
                                                <div class="border-b border-slate-100 pb-3">
                                                    <label class="font-bold text-slate-400 uppercase tracking-wider text-[10px] block mb-1">Nama Lengkap & NIK / NIP</label>
                                                    <p class="font-semibold text-slate-800 text-sm">{{ $item->nama_lengkap }} ({{ $item->nik_nip }})</p>
                                                </div>

                                                {{-- Tambahan Info Akademik di Modal --}}
                                                @if(strtolower($item->kategori_pemohon) == 'mahasiswa')
                                                    <div class="border-b border-slate-100 pb-3">
                                                        <label class="font-bold text-slate-400 uppercase tracking-wider text-[10px] block mb-1">Kategori & Data Akademik</label>
                                                        <p class="font-medium text-slate-800">
                                                            <span class="text-amber-700 font-bold">Mahasiswa</span><br>
                                                            <b>NIM:</b> {{ $item->nim }}<br>
                                                            <b>Program Studi:</b> {{ $item->prodi }}<br>
                                                            <b>Fakultas:</b> {{ $item->fakultas }}
                                                        </p>
                                                    </div>
                                                @else
                                                    <div class="border-b border-slate-100 pb-3">
                                                        <label class="font-bold text-slate-400 uppercase tracking-wider text-[10px] block mb-1">Kategori Pemohon</label>
                                                        <p class="font-medium text-slate-800"><span class="text-slate-600 font-bold">Umum</span></p>
                                                    </div>
                                                @endif

                                                <div class="border-b border-slate-100 pb-3">
                                                    <label class="font-bold text-slate-400 uppercase tracking-wider text-[10px] block mb-1">Tempat, Tanggal Lahir</label>
                                                    <p class="font-semibold text-slate-800">{{ $item->tempat_lahir }}, {{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d F Y') }}</p>
                                                </div>
                                                <div class="border-b border-slate-100 pb-3">
                                                    <label class="font-bold text-slate-400 uppercase tracking-wider text-[10px] block mb-1">Alamat Pemohon</label>
                                                    <p class="font-semibold text-slate-800">{{ $item->alamat }}</p>
                                                </div>
                                                <div class="border-b border-slate-100 pb-3">
                                                    <label class="font-bold text-slate-400 uppercase tracking-wider text-[10px] block mb-1">Asal Instansi / Universitas</label>
                                                    <p class="font-semibold text-slate-800">{{ $item->asal_instansi }}</p>
                                                </div>
                                                <div class="border-b border-slate-100 pb-3">
                                                    <label class="font-bold text-slate-400 uppercase tracking-wider text-[10px] block mb-1">Nomor WhatsApp / HP</label>
                                                    <p class="font-semibold text-slate-800">{{ $item->no_hp }}</p>
                                                </div>
                                                <div class="border-b border-slate-100 pb-3">
                                                    <label class="font-bold text-slate-400 uppercase tracking-wider text-[10px] block mb-1">Judul Penelitian / Kegiatan</label>
                                                    <p class="font-semibold text-slate-800">{{ $item->judul_penelitian }}</p>
                                                </div>
                                                <div class="border-b border-slate-100 pb-3">
                                                    <label class="font-bold text-slate-400 uppercase tracking-wider text-[10px] block mb-1">Tujuan Kegiatan</label>
                                                    <p class="font-semibold text-slate-800">{{ $item->tujuan_kegiatan }}</p>
                                                </div>
                                                <div class="border-b border-slate-100 pb-3">
                                                    <label class="font-bold text-slate-400 uppercase tracking-wider text-[10px] block mb-1">Lokasi Kawasan Konservasi</label>
                                                    <p><span class="bg-emerald-50 text-emerald-900 px-2.5 py-1 rounded-md font-semibold border border-emerald-200">{{ $item->lokasi_penelitian }}</span></p>
                                                </div>
                                                <div class="border-b border-slate-100 pb-3">
                                                    <label class="font-bold text-slate-400 uppercase tracking-wider text-[10px] block mb-1">Tanggal Pelaksanaan Kegiatan</label>
                                                    <p class="font-semibold text-slate-800">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d F Y') }} s/d {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d F Y') }}</p>
                                                </div>
                                                <div>
                                                    <label class="font-bold text-slate-400 uppercase tracking-wider text-[10px] block mb-1">Status Persetujuan</label>
                                                    <p>
                                                        @if($item->status == 'disetujui')
                                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200"><i class="fa-solid fa-circle-check text-emerald-600"></i> Disetujui</span>
                                                        @elseif($item->status == 'menunggu_zoom')
                                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-sky-50 text-sky-800 border border-sky-200"><i class="fa-solid fa-video text-sky-600"></i> Menunggu Zoom</span>
                                                        @elseif($item->status == 'ditolak')
                                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-rose-50 text-rose-800 border border-rose-200"><i class="fa-solid fa-circle-xmark text-rose-600"></i> Ditolak</span>
                                                        @else
                                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-amber-50 text-amber-900 border border-amber-200"><i class="fa-solid fa-clock text-amber-600"></i> Menunggu Persetujuan</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-12 text-slate-400">
                                            <i class="fa-solid fa-folder-open text-4xl mb-3 text-emerald-300 block"></i>
                                            <p class="text-xs font-medium">Tidak ada permohonan yang sesuai dengan kategori ini.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Card Form Export Laporan Modern -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-8 transition-all hover:shadow-md">
                    <div class="bg-gradient-to-r from-emerald-950 to-teal-950 text-white px-6 py-5 flex items-center gap-3 border-b border-amber-500/30">
                        <i class="fa-solid fa-file-excel text-amber-400 text-xl"></i>
                        <div>
                            <h3 class="text-sm font-bold tracking-wide">Export Laporan Data SIMAKSI (BKSDA)</h3>
                            <p class="text-[11px] text-slate-300 font-normal mt-0.5">Pilih kategori dan rentang periode untuk melihat rekapitulasi data resmi</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('admin.export.data') }}" method="GET" target="_blank">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                                <!-- Kategori Permohonan -->
                                <div class="flex flex-col gap-1.5">
                                    <label class="text-[11px] font-bold text-slate-600 uppercase tracking-wider">Kategori Permohonan</label>
                                    <select name="kategori" class="w-full p-2.5 text-xs font-medium text-slate-800 bg-slate-50 border border-slate-200 rounded-lg outline-none focus:bg-white focus:border-emerald-700 focus:ring-2 focus:ring-emerald-700/10 transition-all" required>
                                        <option value="semua">Semua Kategori</option>
                                        <option value="mahasiswa">Mahasiswa</option>
                                        <option value="umum">Umum</option>
                                    </select>
                                </div>

                                <!-- Periode Mulai -->
                                <div class="flex flex-col gap-1.5">
                                    <label class="text-[11px] font-bold text-slate-600 uppercase tracking-wider">Dari (Bulan/Tahun)</label>
                                    <input type="month" name="periode_mulai" class="w-full p-2.5 text-xs font-medium text-slate-800 bg-slate-50 border border-slate-200 rounded-lg outline-none focus:bg-white focus:border-emerald-700 focus:ring-2 focus:ring-emerald-700/10 transition-all" required>
                                </div>

                                <!-- Periode Selesai -->
                                <div class="flex flex-col gap-1.5">
                                    <label class="text-[11px] font-bold text-slate-600 uppercase tracking-wider">Sampai (Bulan/Tahun)</label>
                                    <input type="month" name="periode_selesai" class="w-full p-2.5 text-xs font-medium text-slate-800 bg-slate-50 border border-slate-200 rounded-lg outline-none focus:bg-white focus:border-emerald-700 focus:ring-2 focus:ring-emerald-700/10 transition-all" required>
                                </div>

                                <!-- Tombol Lihat / Preview Data -->
                                <div>
                                    <button type="submit" class="w-full bg-gradient-to-r from-emerald-700 to-teal-700 hover:from-emerald-800 hover:to-teal-800 text-white py-2.5 px-4 rounded-lg text-xs font-bold inline-flex items-center justify-center gap-2 shadow-md shadow-emerald-700/20 transition-all h-[42px]">
                                        <i class="fa-solid fa-eye"></i> Lihat & Unduh Laporan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- JavaScript untuk Modal & Mobile Sidebar Toggle -->
    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            if(modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }
        function closeModal(id) {
            const modal = document.getElementById(id);
            if(modal) {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        }
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if(sidebar && overlay) {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }
        }
    </script>
</body>
</html>