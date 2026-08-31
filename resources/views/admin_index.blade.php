<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin SIPAKAR - BKSDA Sulawesi Tengah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #064e3b;          /* Hijau Tua Utama (Deep Emerald) */
            --primary-dark: #022c22;     /* Hijau Sangat Gelap */
            --primary-light: #f0fdf4;    /* Hijau Muda Lembut */
            --accent: #d97706;           /* Aksen Emas/Kuning */
            --text-main: #0f172a;        /* Teks Utama */
            --text-muted: #475569;       /* Teks Sekunder */
            --border-color: #cbd5e1;     /* Garis Pembatas */
            --bg-body: #f8fafc;          /* Background Modern */
        }

        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--bg-body); color: var(--text-main); padding-bottom: 50px; -webkit-font-smoothing: antialiased; }
        
        /* Navbar Profesional Tunggal */
        .navbar {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 18px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(2, 44, 34, 0.15);
            border-bottom: 4px solid var(--accent);
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .navbar-brand img {
            height: 40px;
            width: auto;
            object-fit: contain;
            background: white;
            padding: 4px 8px;
            border-radius: 6px;
        }
        .navbar h2 { font-size: 17px; font-weight: 800; letter-spacing: 0.5px; text-transform: uppercase; color: white; }
        
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .badge-admin-active {
            background-color: rgba(16, 185, 129, 0.2);
            color: #34d399;
            border: 1px solid rgba(52, 211, 153, 0.4);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-logout {
            background-color: #ef4444;
            color: white;
            padding: 6px 14px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background 0.2s;
        }
        .btn-logout:hover { background-color: #dc2626; }

        .container {
            max-width: 1280px;
            margin: 35px auto;
            padding: 0 24px;
        }

        /* Stats Cards Modern */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            padding: 22px 24px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.03);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -10px rgba(6, 78, 59, 0.1);
        }
        .stat-card .info h3 { font-size: 26px; font-weight: 800; color: var(--text-main); margin-top: 4px; }
        .stat-card .info p { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: var(--text-muted); }
        .stat-icon { 
            width: 52px; 
            height: 52px; 
            border-radius: 14px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 20px; 
            background: var(--primary-light);
            color: var(--primary);
        }

        /* Navigation Filter Tabs Modern */
        .filter-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 24px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 12px;
            overflow-x: auto;
        }
        .tab-btn {
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            color: var(--text-muted);
            background: white;
            border: 1px solid var(--border-color);
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }
        .tab-btn:hover { background: #f1f5f9; color: var(--text-main); border-color: #94a3b8; }
        .tab-btn.active { 
            background: var(--primary); 
            color: white; 
            border-color: var(--primary); 
            box-shadow: 0 4px 12px rgba(6, 78, 59, 0.2);
        }

        /* Card Container Utama */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 20px 24px;
            font-size: 16px;
            font-weight: 700;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 13px; }
        th { background-color: #f8fafc; padding: 14px 18px; font-weight: 700; color: #334155; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; }
        td { padding: 16px 18px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; color: var(--text-main); }
        tr:hover { background-color: #f8fafc; }

        /* Badges Modern */
        .badge-status {
            padding: 6px 10px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 11px;
            display: inline-block;
            text-transform: capitalize;
            letter-spacing: 0.3px;
        }
        .badge-pending { background-color: #fef3c7; color: #b45309; }
        .badge-menunggu_zoom { background-color: #e0f2fe; color: #0369a1; }
        .badge-disetujui { background-color: #d1fae5; color: #047857; }
        .badge-ditolak { background-color: #fee2e2; color: #b91c1c; }

        .badge-location {
            background-color: #f1f5f9;
            color: #334155;
            padding: 6px 10px;
            border-radius: 6px;
            font-weight: 600;
            display: inline-block;
            border: 1px solid #cbd5e1;
        }

        .btn-file {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            background-color: #0284c7;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 4px;
            transition: background 0.2s;
        }
        .btn-file:hover { background-color: #0369a1; }
        
        .empty-state { text-align: center; padding: 50px; color: var(--text-muted); font-weight: 500; }

        /* Action Buttons */
        .action-container {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            align-items: center;
        }
        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            padding: 7px 12px;
            font-size: 11px;
            font-weight: 700;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .btn-action:hover { transform: translateY(-1px); opacity: 0.9; }
        .btn-detail { background-color: #2563eb; }
        .btn-zoom { background-color: #0891b2; }
        .btn-approve { background-color: #059669; }
        .btn-reject { background-color: #d97706; }
        .btn-delete { background-color: #dc2626; }

        .alert-success {
            background-color: #d1fae5;
            border: 1px solid #34d399;
            color: #065f46;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Modal Box Modern */
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(2, 44, 34, 0.5);
            backdrop-filter: blur(4px);
            z-index: 999;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .modal.active { display: flex; }
        .modal-content {
            background: white;
            width: 100%;
            max-width: 700px;
            max-height: 90vh;
            border-radius: 20px;
            overflow-y: auto;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: 1px solid #e2e8f0;
        }
        .modal-header {
            padding: 20px 24px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 700;
        }
        .modal-body { padding: 24px; font-size: 13px; line-height: 1.6; }
        .detail-group { margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; }
        .detail-group label { font-weight: 700; color: var(--text-muted); display: block; margin-bottom: 4px; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; }
        .detail-group p { font-weight: 600; color: var(--text-main); }
        .form-control-sm { width: 100%; padding: 8px 12px; font-size: 12px; border: 1px solid var(--border-color); border-radius: 8px; margin-bottom: 8px; background: #f8fafc; outline: none; }
        .form-control-sm:focus { border-color: var(--primary); background: white; box-shadow: 0 0 0 3px rgba(6, 78, 59, 0.1); }
    </style>
</head>
<body>

    

    <div class="container">
        @if(session('success'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check" style="font-size: 16px;"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Lanjutkan sisa konten statistik, tab, dan tabel Anda di sini -->
    </div>

</body>
</html>



    <div class="container">
        <!-- Letakkan session alert sukses di sini -->
        @if(session('success'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check" style="font-size: 16px;"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Stats Cards & Konten Tabel Admin Anda -->
        <!-- Pastikan struktur card, filter-tabs, tabel, dan modal Anda dibungkus dengan kelas di atas -->
    </div>

</body>
</html>

    <!-- Navbar Admin -->
    <div class="navbar">
        <div style="display: flex; align-items: center; gap: 15px;">
            <img src="{{ asset('images/logo_bksda.png') }}" alt="Logo BKSDA Sulteng" style="height: 45px; background: white; padding: 4px 8px; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <h2>DASHBOARD ADMIN SIPAKAR - BKSDA SULTENG</h2>
        </div>
        <div style="display: flex; align-items: center; gap: 15px;">
            <span style="font-size: 13px; background: #047857; padding: 5px 12px; border-radius: 20px;">
                <i class="fa-solid fa-circle" style="color: #4ade80; font-size: 10px;"></i> Admin Active
            </span>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" style="background: #ef4444; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer;">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">

        <!-- Alert Notifikasi -->
        @if(session('success'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Grid Statistik Permohonan -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="info">
                    <p style="color: #3b82f6;">Semua Masuk</p>
                    <h3>{{ $countSemua }}</h3>
                </div>
                <div class="stat-icon" style="background: #eff6ff; color: #3b82f6;"><i class="fa-solid fa-folder-open"></i></div>
            </div>
            <div class="stat-card">
                <div class="info">
                    <p style="color: #d97706;">Menunggu Persetujuan</p>
                    <h3>{{ $countPending }}</h3>
                </div>
                <div class="stat-icon" style="background: #fffbeb; color: #d97706;"><i class="fa-solid fa-clock"></i></div>
            </div>
            <div class="stat-card">
                <div class="info">
                    <p style="color: #059669;">Disetujui</p>
                    <h3>{{ $countDisetujui }}</h3>
                </div>
                <div class="stat-icon" style="background: #ecfdf5; color: #059669;"><i class="fa-solid fa-circle-check"></i></div>
            </div>
            <div class="stat-card">
                <div class="info">
                    <p style="color: #dc2626;">Ditolak</p>
                    <h3>{{ $countDitolak }}</h3>
                </div>
                <div class="stat-icon" style="background: #fef2f2; color: #dc2626;"><i class="fa-solid fa-circle-xmark"></i></div>
            </div>
        </div>

        <!-- Filter Navigation Tabs -->
        <div class="filter-tabs">
            <a href="{{ route('simaksi.admin', ['status' => 'semua']) }}" class="tab-btn {{ $status == 'semua' ? 'active' : '' }}">
                <i class="fa-solid fa-list"></i> Semua Permohonan ({{ $countSemua }})
            </a>
            <a href="{{ route('simaksi.admin', ['status' => 'pending']) }}" class="tab-btn {{ $status == 'pending' ? 'active' : '' }}">
                <i class="fa-solid fa-hourglass-half"></i> Permohonan Masuk ({{ $countPending }})
            </a>
            <a href="{{ route('simaksi.admin', ['status' => 'disetujui']) }}" class="tab-btn {{ $status == 'disetujui' ? 'active' : '' }}">
                <i class="fa-solid fa-check-circle"></i> Disetujui ({{ $countDisetujui }})
            </a>
            <a href="{{ route('simaksi.admin', ['status' => 'ditolak']) }}" class="tab-btn {{ $status == 'ditolak' ? 'active' : '' }}">
                <i class="fa-solid fa-times-circle"></i> Ditolak ({{ $countDitolak }})
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <span><i class="fa-solid fa-list-check"></i> Daftar Permohonan SIPAKAR</span>
                <span style="font-size: 13px;">Total Tampil: {{ $pendaftarans->count() }} Data</span>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Daftar</th>
                            <th>Nama & Instansi</th>
                            <th>Kontak</th>
                            <th>Judul Kegiatan</th>
                            <th>Lokasi Kawasan</th>
                            <th>Status</th>
                            <th>Berkas</th>
                            <th style="text-align: center;">Aksi & Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftarans as $index => $item)
                            <tr>
                                <td><b>{{ $index + 1 }}</b></td>
                                <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <b>{{ $item->nama_lengkap }}</b><br>
                                    <small style="color: #64748b;">NIK: {{ $item->nik_nip }}</small><br>
                                    <small style="color: #059669;">{{ $item->asal_instansi }}</small>
                                </td>
                                <td>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->no_hp) }}" target="_blank" style="color: #25d366; text-decoration: none; font-weight: 600;">
                                        <i class="fa-brands fa-whatsapp"></i> {{ $item->no_hp }}
                                    </a>
                                </td>
                                <td style="max-width: 200px;">
                                    <b>{{ $item->judul_penelitian }}</b>
                                </td>
                                <td>
                                    <span class="badge-location">{{ $item->lokasi_penelitian }}</span>
                                </td>
                                <td>
                                    @if($item->status == 'disetujui')
                                        <span class="badge-status badge-disetujui"><i class="fa-solid fa-circle-check"></i> Disetujui</span>
                                    @elseif($item->status == 'menunggu_zoom')
                                        <span class="badge-status badge-menunggu_zoom"><i class="fa-solid fa-video"></i> Menunggu Zoom</span>
                                    @elseif($item->status == 'ditolak')
                                        <span class="badge-status badge-ditolak"><i class="fa-solid fa-circle-xmark"></i> Ditolak</span>
                                    @else
                                        <span class="badge-status badge-pending"><i class="fa-solid fa-clock"></i> Menunggu</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->file_ktp)
                                        <a href="{{ asset('storage/' . $item->file_ktp) }}" target="_blank" class="btn-file"><i class="fa-solid fa-id-card"></i> KTP</a><br>
                                    @endif
                                    @if($item->file_surat_pengantar)
                                        <a href="{{ asset('storage/' . $item->file_surat_pengantar) }}" target="_blank" class="btn-file"><i class="fa-solid fa-envelope"></i> Surat</a><br>
                                    @endif
                                    @if($item->file_proposal)
                                        <a href="{{ asset('storage/' . $item->file_proposal) }}" target="_blank" class="btn-file" style="background-color: #e11d48;"><i class="fa-solid fa-file-pdf"></i> Proposal</a>
                                    @endif
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <div style="display: flex; gap: 4px; justify-content: center; flex-wrap: wrap;">
                                        
                                        <!-- Tombol Lihat Detail Lengkap -->
                                        <button type="button" class="btn-action btn-detail" onclick="openModal('modal-{{ $item->id }}')" title="Lihat Formulir Lengkap">
                                            <i class="fa-solid fa-eye"></i> Detail
                                        </button>

                                        <!-- 1. Form Jadwal Zoom (Jika status masih pending atau ingin jadwalkan zoom) -->
                                        <form action="{{ route('admin.simaksi.updateStatus', $item->id) }}" method="POST" style="display:inline-block; border: 1px dashed #0284c7; padding: 5px; border-radius: 5px; background: #f0f9ff; margin-bottom: 4px; text-align: left; width: 100%;">
                                            @csrf 
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="menunggu_zoom">
                                            <label style="font-size: 10px; font-weight: bold; color: #0284c7; display:block;">Jadwalkan Presentasi Zoom:</label>
                                            <input type="datetime-local" name="tanggal_zoom" class="form-control-sm" value="{{ $item->tanggal_zoom ? \Carbon\Carbon::parse($item->tanggal_zoom)->format('Y-m-d\TH:i') : '' }}" required>
                                            <input type="text" name="link_zoom" class="form-control-sm" placeholder="Link Zoom / Meeting" value="{{ $item->link_zoom }}" required>
                                            <button type="submit" class="btn-action btn-zoom" style="width: 100%; font-size: 10px;" title="Kirim Jadwal Zoom ke Pemohon">
                                                <i class="fa-solid fa-video"></i> Kirim Jadwal Zoom
                                            </button>
                                        </form>

                                        <!-- 2. Form Setuju (Dilengkapi Upload Surat Izin PDF & Catatan Admin) -->
                                        @if($item->status != 'disetujui')
                                            <form action="{{ route('admin.simaksi.updateStatus', $item->id) }}" method="POST" enctype="multipart/form-data" style="display:inline-block; border: 1px dashed #10b981; padding: 5px; border-radius: 5px; background: #ecfdf5; margin-bottom: 4px; text-align: left; width: 100%;">
                                                @csrf 
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="disetujui">
                                                
                                                <label style="font-size: 10px; font-weight: bold; color: #10b981; display:block;">Upload Surat Izin (PDF):</label>
                                                <input type="file" name="surat_izin" class="form-control-sm" accept=".pdf" required>
                                                
                                                <textarea name="catatan_admin" class="form-control-sm" placeholder="Catatan/SOP final (opsional)" rows="2">{{ $item->catatan_admin }}</textarea>

                                                <button type="submit" class="btn-action btn-approve" style="width: 100%; font-size: 10px;" onclick="return confirm('Setujui permohonan ini dan unggah surat izin?')" title="Setujui Permohonan">
                                                    <i class="fa-solid fa-check"></i> Setujui & Kirim Surat
                                                </button>
                                            </form>
                                        @endif

                                        <!-- 3. Tombol Tolak -->
                                        @if($item->status != 'ditolak')
                                            <form action="{{ route('admin.simaksi.updateStatus', $item->id) }}" method="POST" style="margin:0; display:inline-block;">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="ditolak">
                                                <button type="submit" class="btn-action btn-reject" onclick="return confirm('Tolak permohonan ini?')" title="Tolak">
                                                    <i class="fa-solid fa-xmark"></i> Tolak
                                                </button>
                                            </form>
                                          @endif

                                        <!-- 4. Tombol Hapus Data -->
                                        <form action="{{ route('admin.simaksi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus permanen permohonan {{ $item->nama_lengkap }}?');" style="margin: 0; display:inline-block;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Hapus Data">
                                                <i class="fa-solid fa-trash"></i> Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                            <!-- Popup Modal Detail Formulir Pemohon -->
                            <div id="modal-{{ $item->id }}" class="modal">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3><i class="fa-solid fa-file-lines"></i> Detail Formulir SIMAKSI - {{ $item->nama_lengkap }}</h3>
                                        <button onclick="closeModal('modal-{{ $item->id }}')" style="background:none; border:none; color:white; font-size:18px; cursor:pointer;">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="detail-group">
                                            <label>Nama Lengkap & NIK / NIP</label>
                                            <p>{{ $item->nama_lengkap }} ({{ $item->nik_nip }})</p>
                                        </div>
                                        <div class="detail-group">
                                            <label>Tempat, Tanggal Lahir</label>
                                            <p>{{ $item->tempat_lahir }}, {{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d F Y') }}</p>
                                        </div>
                                        <div class="detail-group">
                                            <label>Alamat Pemohon</label>
                                            <p>{{ $item->alamat }}</p>
                                        </div>
                                        <div class="detail-group">
                                            <label>Asal Instansi / Universitas</label>
                                            <p>{{ $item->asal_instansi }}</p>
                                        </div>
                                        <div class="detail-group">
                                            <label>Nomor WhatsApp / HP</label>
                                            <p>{{ $item->no_hp }}</p>
                                        </div>
                                        <div class="detail-group">
                                            <label>Judul Penelitian / Kegiatan</label>
                                            <p>{{ $item->judul_penelitian }}</p>
                                        </div>
                                        <div class="detail-group">
                                            <label>Tujuan Kegiatan</label>
                                            <p>{{ $item->tujuan_kegiatan }}</p>
                                        </div>
                                        <div class="detail-group">
                                            <label>Lokasi Kawasan Konservasi</label>
                                            <p><span class="badge-location">{{ $item->lokasi_penelitian }}</span></p>
                                        </div>
                                        <div class="detail-group">
                                            <label>Tanggal Pelaksanaan Kegiatan</label>
                                            <p>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d F Y') }} s/d {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d F Y') }}</p>
                                        </div>
                                        <div class="detail-group">
                                            <label>Status Persetujuan</label>
                                            <p>
                                                @if($item->status == 'disetujui')
                                                    <span class="badge-status badge-disetujui"><i class="fa-solid fa-circle-check"></i> Disetujui</span>
                                                @elseif($item->status == 'menunggu_zoom')
                                                    <span class="badge-status badge-menunggu_zoom"><i class="fa-solid fa-video"></i> Menunggu Zoom</span>
                                                @elseif($item->status == 'ditolak')
                                                    <span class="badge-status badge-ditolak"><i class="fa-solid fa-circle-xmark"></i> Ditolak</span>
                                                @else
                                                    <span class="badge-status badge-pending"><i class="fa-solid fa-clock"></i> Menunggu Persetujuan</span>
                                              @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="9" class="empty-state">
                                <i class="fa-solid fa-folder-open" style="font-size: 32px; margin-bottom: 10px; color: #cbd5e1;"></i>
                                <p>Tidak ada permohonan yang sesuai dengan kategori ini.</p>
                            </td>
                        </tr>
                    @endforelse
                  </tbody>
            </table>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.add('active');
        }
        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }
    </script>
</body>
</html>