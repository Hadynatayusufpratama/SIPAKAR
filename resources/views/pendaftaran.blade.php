<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir SIPAKAR - BKSDA Sulawesi Tengah</title>
    <!-- FontAwesome & Font Google -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
<style>
    :root {
        /* Skema Warna Hijau Tua Profesional & Modern */
        --primary: #064e3b;          /* Hijau Tua Utama (Deep Emerald) */
        --primary-dark: #022c22;     /* Hijau Sangat Gelap */
        --primary-light: #f0fdf4;    /* Hijau Muda Lembut untuk Background */
        --accent: #d97706;           /* Aksen Kuning Keemasan / Gold */
        --text-main: #0f172a;        /* Teks Utama Gelap Modern */
        --text-muted: #475569;       /* Teks Sekunder Abu Elegan */
        --border-color: #cbd5e1;     /* Warna Garis Pembatas */
        --bg-body: #f1f5f9;          /* Background Halaman Modern */
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    body {
        background-color: var(--bg-body);
        color: var(--text-main);
        padding-bottom: 60px;
        -webkit-font-smoothing: antialiased;
    }

    /* Header Styling */
    .header {
        background: linear-gradient(135deg, #022c22 0%, #064e3b 100%);
        color: white;
        border-bottom: 4px solid var(--accent);
        padding: 22px 0;
        box-shadow: 0 10px 25px -5px rgba(2, 44, 34, 0.2);
    }

    .header-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
    }

    .header-title {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .header-icon-box {
        background-color: white;
        padding: 10px 16px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .header-logo {
        height: 48px;
        width: auto;
        display: block;
    }

    .header-text h1 {
        font-size: 18px;
        font-weight: 800;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        color: #ffffff;
    }

    .header-text p {
        font-size: 11px;
        color: #a7f3d0;
        margin-top: 3px;
        font-weight: 500;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .badge-simaksi {
        background-color: var(--accent);
        color: #ffffff;
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        box-shadow: 0 2px 6px rgba(217, 119, 6, 0.3);
    }

    .user-pill {
        background-color: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        padding: 6px 16px;
        border-radius: 30px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 500;
    }

    .user-pill i {
        color: #34d399;
    }

    .btn-logout {
        background-color: rgba(239, 68, 68, 0.15);
        color: #fca5a5;
        border: 1px solid rgba(239, 68, 68, 0.3);
        padding: 6px 16px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.25s ease;
        text-decoration: none;
    }

    .btn-logout:hover {
        background-color: #dc2626;
        color: white;
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }

    /* Container Main */
    .main-container {
        max-width: 1100px;
        margin: 35px auto 0 auto;
        padding: 0 20px;
    }

    .card {
        background-color: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.06);
        border: 1px solid #e2e8f0;
        overflow: hidden;
        margin-bottom: 25px;
    }

    .card-header {
        background: linear-gradient(135deg, #064e3b 0%, #022c22 100%);
        color: white;
        padding: 20px 28px;
        font-size: 16px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 12px;
        letter-spacing: 0.3px;
    }

    .card-body {
        padding: 32px;
    }

    /* Form Styling */
    .form-section {
        margin-bottom: 35px;
    }

    .section-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--primary);
        text-transform: uppercase;
        letter-spacing: 0.6px;
        border-bottom: 2px solid var(--primary-light);
        padding-bottom: 10px;
        margin-bottom: 22px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .grid-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .full-width {
        grid-column: span 2;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group label {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-main);
    }

    .form-control {
        padding: 12px 16px;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        font-size: 14px;
        outline: none;
        transition: all 0.25s ease;
        width: 100%;
        background-color: #f8fafc;
        color: var(--text-main);
    }

    .form-control:focus {
        border-color: var(--primary);
        background-color: white;
        box-shadow: 0 0 0 4px rgba(6, 78, 59, 0.12);
    }

    textarea.form-control {
        resize: vertical;
    }

    .file-box {
        background-color: #f8fafc;
        border: 2px dashed #cbd5e1;
        padding: 16px;
        border-radius: 12px;
        transition: all 0.25s ease;
    }

    .file-box:hover {
        border-color: var(--primary);
        background-color: var(--primary-light);
    }

    /* Alert Success */
    .alert-success {
        background-color: var(--primary-light);
        border-left: 5px solid var(--primary);
        color: #064e3b;
        padding: 16px 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 14px;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(6, 78, 59, 0.05);
    }

    /* Button Submit */
    .btn-submit {
        background: linear-gradient(135deg, #064e3b 0%, #022c22 100%);
        color: white;
        border: none;
        padding: 14px 32px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 15px rgba(6, 78, 59, 0.25);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(6, 78, 59, 0.35);
        background: linear-gradient(135deg, #04392c 0%, #011b15 100%);
    }

    .btn-container {
        text-align: right;
        padding-top: 15px;
    }

    /* Statistics Cards */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: white;
        padding: 22px 24px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 18px;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .stat-icon.pending { background: #fef3c7; color: #b45309; }
    .stat-icon.approved { background: #d1fae5; color: #064e3b; }
    .stat-icon.total { background: #e0f2fe; color: #0369a1; }

    .stat-info h4 { font-size: 22px; font-weight: 700; color: var(--text-main); }
    .stat-info p { font-size: 13px; color: var(--text-muted); font-weight: 500; margin-top: 2px; }

    /* Navigasi Tab Switcher */
    .tab-navigation {
        display: flex;
        gap: 12px;
        margin-bottom: 25px;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 2px;
    }

    .tab-btn {
        background: none;
        border: none;
        padding: 12px 24px;
        font-size: 14px;
        font-weight: 600;
        color: var(--text-muted);
        cursor: pointer;
        border-bottom: 3px solid transparent;
        margin-bottom: -4px;
        display: flex;
        align-items: center;
        gap: 10px;
        border-radius: 8px 8px 0 0;
        transition: all 0.25s ease;
    }

    .tab-btn:hover {
        color: var(--primary);
        background-color: rgba(6, 78, 59, 0.04);
    }

    .tab-btn.active {
        color: var(--primary);
        border-bottom-color: var(--primary);
        background-color: white;
        box-shadow: 0 -4px 12px rgba(15, 23, 42, 0.03);
    }

    /* Tabel Status */
    .table-responsive {
        overflow-x: auto;
    }

    .status-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 14px;
    }

    .status-table th {
        background-color: #f8fafc;
        color: var(--text-main);
        padding: 14px 18px;
        font-weight: 700;
        border-bottom: 2px solid #e2e8f0;
    }

    .status-table td {
        padding: 18px;
        border-bottom: 1px solid #e2e8f0;
        color: var(--text-muted);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-pending { background-color: #fef3c7; color: #b45309; }
    .badge-approved { background-color: #d1fae5; color: #064e3b; }
    .badge-rejected { background-color: #fee2e2; color: #b91c1c; }

    .btn-download-pdf {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background-color: #0284c7;
        color: white;
        padding: 6px 12px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
        margin-top: 8px;
        transition: background-color 0.2s;
        box-shadow: 0 2px 6px rgba(2, 132, 199, 0.2);
    }

    .btn-download-pdf:hover {
        background-color: #0369a1;
    }

    /* Profil Pengguna */
    .profile-header-card {
        display: flex;
        align-items: center;
        gap: 22px;
        background: linear-gradient(135deg, var(--primary-light) 0%, #ffffff 100%);
        padding: 24px;
        border-radius: 14px;
        margin-bottom: 30px;
        border: 1px solid #a7f3d0;
    }

    .profile-avatar {
        width: 75px;
        height: 75px;
        background: linear-gradient(135deg, #064e3b 0%, #022c22 100%);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        box-shadow: 0 6px 15px rgba(6, 78, 59, 0.25);
    }

    .profile-title h3 {
        font-size: 20px;
        font-weight: 700;
        color: var(--primary);
    }

    .profile-title p {
        font-size: 13px;
        color: var(--text-muted);
        margin-top: 4px;
    }

    .profile-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .info-item {
        background: #f8fafc;
        padding: 16px 20px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }

    .info-item label {
        font-size: 11px;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
        display: block;
        margin-bottom: 6px;
    }

    .info-item p {
        font-size: 15px;
        font-weight: 600;
        color: var(--text-main);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .grid-2, .grid-3, .stats-container, .profile-info-grid {
            grid-template-columns: 1fr;
        }
        .full-width {
            grid-column: span 1;
        }
        .header-container {
            flex-direction: column;
            text-align: center;
        }
        .header-title {
            flex-direction: column;
        }
        .header-right {
            flex-direction: column;
            width: 100%;
            gap: 10px;
        }
        .user-pill, .btn-logout, .badge-simaksi {
            width: 100%;
            justify-content: center;
        }
        .btn-submit {
            width: 100%;
            justify-content: center;
        }
        .profile-header-card {
            flex-direction: column;
            text-align: center;
        }
        .tab-navigation {
            flex-direction: column;
            gap: 5px;
        }
        .tab-btn {
            border-radius: 8px;
            justify-content: center;
        }
    }
</style>

    <!-- Header BKSDA Sulteng -->
    <header class="header">
        <div class="header-container">
            <div class="header-title">
                <div class="header-icon-box">
                    <img src="{{ asset('images/logo_bksda.png') }}" alt="Logo BKSDA Sulteng" class="header-logo">
                </div>
                <div class="header-text">
                    <h1>BALAI KSDA SULAWESI TENGAH</h1>
                    <p>Kementerian Lingkungan Hidup dan Kehutanan Republik Indonesia</p>
                </div>
            </div>
            <div class="header-right">
                <span class="badge-simaksi">SIPAKAR ONLINE</span>
                
                <!-- Info Akun Pengguna di Header -->
                <div class="user-pill">
                    <i class="fa-solid fa-circle-user"></i>
                    <span>{{ Auth::user()->name ?? 'Pengguna' }}</span>
                </div>

                <form action="{{ route('logout') }}" method="POST" style="display: inline; width: 100%;">
                    @csrf
                    <button type="submit" class="btn-logout" style="width: 100%; justify-content: center;">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="main-container">

        <!-- Notification Success -->
        @if(session('success'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check" style="font-size: 20px;"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Card Kartu Statistik Ringkasan Status -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon pending"><i class="fa-solid fa-clock"></i></div>
                <div class="stat-info">
                    <h4>{{ $totalPending ?? 0 }}</h4>
                    <p>Dalam Proses</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon approved"><i class="fa-solid fa-circle-check"></i></div>
                <div class="stat-info">
                    <h4>{{ $totalDisetujui ?? 0 }}</h4>
                    <p>Disetujui</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon total"><i class="fa-solid fa-folder-open"></i></div>
                <div class="stat-info">
                    <h4>{{ $totalPermohonan ?? 0 }}</h4>
                    <p>Total Permohonan</p>
                </div>
            </div>
        </div>

        <!-- Tab Switcher Navigation -->
        <div class="tab-navigation">
            <button class="tab-btn active" id="btn-tab-form" onclick="toggleTab('form')">
                <i class="fa-solid fa-file-pen"></i> Form Pengajuan Baru
            </button>
            <button class="tab-btn" id="btn-tab-status" onclick="toggleTab('status')">
                <i class="fa-solid fa-list-check"></i> Status & Permohonan Dikirim
            </button>
            <button class="tab-btn" id="btn-tab-profile" onclick="toggleTab('profile')">
                <i class="fa-solid fa-user-gear"></i> Profil Saya
            </button>
        </div>

        <!-- SECTION TAB 1: FORMULIR PENDAFTARAN -->
        <div id="tab-content-form" class="card">
            <div class="card-header">
                <i class="fa-solid fa-file-pen"></i>
                <span>Formulir SIPAKAR (Sistem Perizinan Akses & Masuk Kawasan Konservasi)</span>
            </div>

            <div class="card-body">
                <form action="{{ route('simaksi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Section 1: Identitas Pemohon -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="fa-solid fa-id-card"></i>
                            <span>1. Data Identitas Pemohon</span>
                        </div>
                        <div class="grid-2">
                            <div class="form-group">
                                <label>Nama Lengkap *</label>
                                <input type="text" name="nama_lengkap" class="form-control" value="{{ Auth::user()->name ?? '' }}" required placeholder="Masukkan nama lengkap">
                            </div>
                            <div class="form-group">
                                <label>NIK / NIP *</label>
                                <input type="text" name="nik_nip" class="form-control" required placeholder="Masukkan NIK atau NIP">
                            </div>
                            <div class="form-group full-width">
                                <label>Alamat Lengkap *</label>
                                <textarea name="alamat" rows="2" class="form-control" required placeholder="Masukkan alamat lengkap"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir *</label>
                                <input type="text" name="tempat_lahir" class="form-control" required placeholder="Contoh: Palu">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir *</label>
                                <input type="date" name="tanggal_lahir" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Nomor WhatsApp / HP *</label>
                                <input type="text" name="no_hp" class="form-control" required placeholder="08xxxxxxxxxx">
                            </div>
                            <div class="form-group">
                                <label>Asal Instansi / Universitas *</label>
                                <input type="text" name="asal_instansi" class="form-control" required placeholder="Contoh: Universitas Tadulako">
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Detail Kegiatan -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="fa-solid fa-compass"></i>
                            <span>2. Detail Kegiatan / Penelitian</span>
                        </div>
                        <div class="grid-2">
                            <div class="form-group full-width">
                                <label>Judul Penelitian / Kegiatan *</label>
                                <input type="text" name="judul_penelitian" class="form-control" required placeholder="Masukkan judul penelitian">
                            </div>
                            <div class="form-group full-width">
                                <label>Tujuan Kegiatan *</label>
                                <textarea name="tujuan_kegiatan" rows="2" class="form-control" required placeholder="Jelaskan secara singkat tujuan kegiatan"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Mulai *</label>
                                <input type="date" name="tanggal_mulai" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Selesai *</label>
                                <input type="date" name="tanggal_selesai" class="form-control" required>
                            </div>
                            <div class="form-group full-width">
                                <label>Lokasi Kawasan Konservasi *</label>
                                <select name="lokasi_penelitian" class="form-control" required>
                                    <option value="" disabled selected>-- Pilih Kawasan Konservasi BKSDA Sulteng --</option>
                                    
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
                                        <option value="Cagar Alam Pamona">Cagar Alam Pamona</option>
                                        <option value="Cagar Alam Tanjung Api">Cagar Alam Tanjung Api</option>
                                        <option value="Cagar Alam Patipati">Cagar Alam Patipati</option>
                                        <option value="Cagar Alam Morowali">Cagar Alam Morowali</option>
                                    </optgroup>

                                    <optgroup label="Suaka Margasatwa (SM)">
                                        <option value="Suaka Margasatwa Pulau Dolangan">Suaka Margasatwa Pulau Dolangan</option>
                                        <option value="Suaka Margasatwa Pinjan Tj. Matop">Suaka Margasatwa Pinjan Tj. Matop</option>
                                        <option value="Suaka Margasatwa Pulau Pasoso">Suaka Margasatwa Pulau Pasoso</option>
                                        <option value="Suaka Margasatwa Lombuyan">Suaka Margasatwa Lombuyan</option>
                                        <option value="Suaka Margasatwa Bakiriang">Suaka Margasatwa Bakiriang</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Upload Berkas -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="fa-solid fa-file-arrow-up"></i>
                            <span>3. Berkas Persyaratan</span>
                        </div>
                        <div class="grid-3">
                            <div class="file-box">
                                <div class="form-group">
                                    <label>Scan KTP/Identitas *</label>
                                    <small style="color: var(--text-muted); font-size: 11px; margin-bottom: 4px;">
                                        Ukuran: <strong>Min. 2 MB - Max. 5 MB</strong>
                                    </small>
                                    <input type="file" name="file_ktp" accept=".pdf,.jpg,.jpeg,.png" required style="font-size: 12px;">
                                </div>
                            </div>
                            <div class="file-box">
                                <div class="form-group">
                                    <label>Surat Pengantar *</label>
                                    <small style="color: var(--text-muted); font-size: 11px; margin-bottom: 4px;">
                                        Ukuran: <strong>Min. 2 MB - Max. 5 MB</strong>
                                    </small>
                                    <input type="file" name="file_surat_pengantar" accept=".pdf,.jpg,.jpeg,.png" required style="font-size: 12px;">
                                </div>
                            </div>
                            <div class="file-box">
                                <div class="form-group">
                                    <label>Proposal (PDF) *</label>
                                    <small style="color: var(--text-muted); font-size: 11px; margin-bottom: 4px;">
                                        Ukuran: <strong>Maksimal 10 MB</strong>
                                    </small>
                                    <input type="file" name="file_proposal" accept=".pdf" required style="font-size: 12px;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Kirim -->
                    <div class="btn-container">
                        <button type="submit" class="btn-submit">
                            <i class="fa-solid fa-paper-plane"></i> Kirim Permohonan SIPAKAR
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <!-- SECTION TAB 2: TABEL STATUS PERMOHONAN -->
        <div id="tab-content-status" class="card" style="display: none;">
            <div class="card-header">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span>Riwayat & Status Permohonan Dikirim</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="status-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pemohon</th>
                                <th>Judul Kegiatan</th>
                                <th>Lokasi Kawasan</th>
                                <th>Tgl Pengajuan</th>
                                <th>Status Persetujuan</th>
                                <th>Jadwal & Link Zoom</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permohonan ?? [] as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $item->nama_lengkap }}</strong><br>
                                    <small style="color: var(--text-muted);">{{ $item->asal_instansi }}</small>
                                </td>
                                <td>{{ $item->judul_penelitian }}</td>
                                <td>{{ $item->lokasi_penelitian }}</td>
                                <td>{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</td>
                                <td>
                                    @php 
                                        $status = strtolower($item->status ?? 'pending'); 
                                    @endphp

                                    @if($status == 'pending')
                                        <span class="status-badge badge-pending">
                                            <i class="fa-solid fa-spinner fa-spin"></i> Dalam Proses
                                        </span>
                                    @elseif($status == 'menunggu_zoom')
                                        <span class="status-badge" style="background-color:#ffc107; color:#000; padding: 4px 10px; border-radius: 4px;">
                                            <i class="fa-solid fa-video"></i> Menunggu Zoom
                                        </span>
                                    @elseif($status == 'disetujui')
                                        <span class="status-badge badge-approved">
                                            <i class="fa-solid fa-circle-check"></i> Disetujui
                                        </span><br>

                                        @if(!empty($item->surat_izin))
                                            <a href="{{ route('simaksi.downloadPdf', $item->id) }}" class="btn-download-pdf" target="_blank">
                                                <i class="fa-solid fa-file-pdf"></i> Unduh Surat Izin
                                            </a>
                                        @else
                                            <small class="text-warning d-block mt-1">Menunggu admin mengunggah berkas.</small>
                                        @endif
                                    @elseif($status == 'ditolak')
                                        <span class="status-badge badge-rejected">
                                            <i class="fa-solid fa-circle-xmark"></i> Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($item->link_zoom) || !empty($item->tanggal_zoom))
                                        <div style="font-size: 0.85rem;">
                                            @if(!empty($item->tanggal_zoom))
                                                <strong>Jadwal:</strong> {{ \Carbon\Carbon::parse($item->tanggal_zoom)->format('d M Y, H:i') }}<br>
                                            @endif
                                            @if(!empty($item->link_zoom))
                                                <a href="{{ $item->link_zoom }}" target="_blank" style="display: inline-block; margin-top: 4px; padding: 4px 10px; background-color: #0d6efd; color: white; border-radius: 4px; text-decoration: none;">
                                                    <i class="fa-solid fa-video"></i> Gabung Zoom
                                                </a>
                                            @endif
                                        </div>
                                    @else
                                        <span style="color: #6c757d; font-size: 0.85rem;">Belum ada jadwal</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 50px 20px; color: var(--text-muted);">
                                    <i class="fa-solid fa-folder-open" style="font-size: 40px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>
                                    Belum ada permohonan yang dikirim.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- SECTION TAB 3: PROFIL PENGGUNA -->
        <div id="tab-content-profile" class="card" style="display: none;">
            <div class="card-header">
                <i class="fa-solid fa-id-card-clip"></i>
                <span>Profil Akun Pemohon</span>
            </div>
            <div class="card-body">
                <!-- Kartu Header Profil -->
                <div class="profile-header-card">
                    <div class="profile-avatar">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="profile-title">
                        <h3>{{ Auth::user()->name ?? 'Pengguna SIPAKAR' }}</h3>
                        <p><i class="fa-solid fa-envelope" style="margin-right: 6px;"></i>{{ Auth::user()->email ?? 'email@domain.com' }}</p>
                    </div>
                </div>

                <!-- Informasi Detail Profil -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fa-solid fa-circle-info"></i>
                        <span>Informasi Akun & Pengajuan</span>
                    </div>
                    
                    <div class="profile-info-grid">
                        <div class="info-item">
                            <label>Nama Pengguna</label>
                            <p>{{ Auth::user()->name ?? '-' }}</p>
                        </div>
                        <div class="info-item">
                            <label>Alamat Email</label>
                            <p>{{ Auth::user()->email ?? '-' }}</p>
                        </div>
                        <div class="info-item">
                            <label>Tanggal Terdaftar</label>
                            <p>{{ Auth::user()->created_at ? Auth::user()->created_at->format('d F Y') : '-' }}</p>
                        </div>
                        <div class="info-item">
                            <label>Total Pengajuan Permohonan</label>
                            <p>{{ $totalPermohonan ?? 0 }} Berkas Permohonan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Script Tab Switcher -->
    <script>
        // Fungsi utama tab switcher
        function toggleTab(tab) {
            const formTab = document.getElementById('tab-content-form');
            const statusTab = document.getElementById('tab-content-status');
            const profileTab = document.getElementById('tab-content-profile');
            
            const btnForm = document.getElementById('btn-tab-form');
            const btnStatus = document.getElementById('btn-tab-status');
            const btnProfile = document.getElementById('btn-tab-profile');

            // Sembunyikan semua tab jika elemennya ada
            if (formTab) formTab.style.display = 'none';
            if (statusTab) statusTab.style.display = 'none';
            if (profileTab) profileTab.style.display = 'none';

            // Bersihkan class active dari semua tombol jika tombolnya ada
            if (btnForm) btnForm.classList.remove('active');
            if (btnStatus) btnStatus.classList.remove('active');
            if (btnProfile) btnProfile.classList.remove('active');

            // Tampilkan tab yang dipilih
            if (tab === 'form') {
                if (formTab) formTab.style.display = 'block';
                if (btnForm) btnForm.classList.add('active');
            } else if (tab === 'status') {
                if (statusTab) statusTab.style.display = 'block';
                if (btnStatus) btnStatus.classList.add('active');
            } else if (tab === 'profile') {
                if (profileTab) profileTab.style.display = 'block';
                if (btnProfile) btnProfile.classList.add('active');
            }
        }

        // TAMBAHAN OTOMATIS: Script ini memaksa mencari tombol yang ada tulisan "Profil Saya" 
        // dan langsung memasang fungsi klik secara otomatis tanpa perlu pusing cari kodingan tombol aslinya!
        document.addEventListener("DOMContentLoaded", function() {
            const allElements = document.querySelectorAll('a, button, div, span');
            allElements.forEach(el => {
                if (el.textContent.trim() === 'Profil Saya') {
                    el.style.cursor = 'pointer';
                    el.onclick = function(e) {
                        e.preventDefault();
                        toggleTab('profile');
                    };
                }
            });
        });
    </script>