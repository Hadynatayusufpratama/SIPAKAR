<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Permohonan - BKSDA Sulteng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body { background-color: #f8fafc; color: #1e293b; padding-bottom: 50px; }
        
        .navbar {
            background-color: #065f46;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 4px solid #f59e0b;
        }
        .navbar h2 { font-size: 18px; font-weight: 700; }
        
        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .card-header {
            background-color: #047857;
            color: white;
            padding: 16px 20px;
            font-size: 16px;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-body { padding: 25px; }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .form-group.full-width { grid-column: span 2; }

        label { font-size: 13px; font-weight: 600; color: #334155; }
        input, textarea, select {
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 13px;
            outline: none;
            transition: border-color 0.2s;
        }
        input:focus, textarea:focus { border-color: #047857; }

        .btn-container {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-primary { background-color: #047857; color: white; }
        .btn-secondary { background-color: #64748b; color: white; }
        .btn:hover { opacity: 0.9; }

        .file-info { font-size: 11px; color: #64748b; margin-top: 4px; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div style="display: flex; align-items: center; gap: 15px;">
            <img src="{{ asset('images/logo-bksda.png') }}" alt="Logo BKSDA Sulteng" style="height: 45px; background: white; padding: 4px 8px; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <h2>DASHBOARD ADMIN SIPAKAR - BKSDA SULTENG</h2>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="card">
            <div class="card-header">
                <span><i class="fa-solid fa-pen-to-square"></i> Edit Data Permohonan SIPAKAR</span>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.sipakar.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $item->nama_lengkap) }}" required>
                        </div>

                        <div class="form-group">
                            <label>NIK / NIP</label>
                            <input type="text" name="nik_nip" value="{{ old('nik_nip', $item->nik_nip) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $item->tempat_lahir) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $item->tanggal_lahir) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Nomor HP / WA</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $item->no_hp) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Asal Instansi</label>
                            <input type="text" name="asal_instansi" value="{{ old('asal_instansi', $item->asal_instansi) }}" required>
                        </div>

                        <div class="form-group full-width">
                            <label>Alamat Lengkap</label>
                            <textarea name="alamat" rows="2" required>{{ old('alamat', $item->alamat) }}</textarea>
                        </div>

                        <div class="form-group full-width">
                            <label>Judul Penelitian / Kegiatan</label>
                            <input type="text" name="judul_penelitian" value="{{ old('judul_penelitian', $item->judul_penelitian) }}" required>
                        </div>

                        <div class="form-group full-width">
                            <label>Tujuan Kegiatan</label>
                            <textarea name="tujuan_kegiatan" rows="3" required>{{ old('tujuan_kegiatan', $item->tujuan_kegiatan) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Lokasi Kawasan Penelitian</label>
                            <input type="text" name="lokasi_penelitian" value="{{ old('lokasi_penelitian', $item->lokasi_penelitian) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $item->tanggal_mulai) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $item->tanggal_selesai) }}" required>
                        </div>

                        <!-- Upload Ulang Berkas (Opsional) -->
                        <div class="form-group">
                            <label>Ganti File KTP (Opsional)</label>
                            <input type="file" name="file_ktp" accept=".pdf,.jpg,.jpeg,.png">
                            <span class="file-info">Kosongkan jika tidak ingin mengganti file KTP.</span>
                        </div>

                        <div class="form-group">
                            <label>Ganti Surat Pengantar (Opsional)</label>
                            <input type="file" name="file_surat_pengantar" accept=".pdf,.jpg,.jpeg,.png">
                            <span class="file-info">Kosongkan jika tidak ingin mengganti Surat Pengantar.</span>
                        </div>

                        <div class="form-group full-width">
                            <label>Ganti File Proposal (Opsional)</label>
                            <input type="file" name="file_proposal" accept=".pdf">
                            <span class="file-info">Kosongkan jika tidak ingin mengganti File Proposal PDF.</span>
                        </div>
                    </div>

                    <div class="btn-container">
                        <a href="{{ route('simaksi.admin') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-arrow-left"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>