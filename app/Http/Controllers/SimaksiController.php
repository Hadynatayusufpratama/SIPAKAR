<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranSimaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class SimaksiController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Mengambil permohonan khusus user yang sedang login
        $permohonan = PendaftaranSimaksi::where('user_id', $userId)
                                    ->latest()
                                    ->get();

        // Hitung statistik khusus user yang sedang login
        $totalPending   = PendaftaranSimaksi::where('user_id', $userId)->where('status', 'pending')->count();
        $totalDisetujui  = PendaftaranSimaksi::where('user_id', $userId)->where('status', 'disetujui')->count();
        $totalPermohonan = PendaftaranSimaksi::where('user_id', $userId)->count();

        return view('pendaftaran', compact('permohonan', 'totalPending', 'totalDisetujui', 'totalPermohonan'));
    }

    public function adminIndex(Request $request)
{
    // Ambil parameter status dan kategori dari URL (default 'semua')
    $status = $request->get('status', 'semua');
    $kategori = $request->get('kategori', 'semua');

    $query = PendaftaranSimaksi::query();

    // Filter berdasarkan status jika bukan 'semua'
    if ($status !== 'semua') {
        if ($status === 'pending') {
            $query->whereIn('status', ['pending', 'menunggu_zoom']);
        } else {
            $query->where('status', $status);
        }
        
    }
    

    // Filter berdasarkan kategori_pemohon jika bukan 'semua' (Menggunakan LIKE agar tidak case-sensitive)
    if ($kategori !== 'semua') {
        $query->where('kategori_pemohon', 'LIKE', $kategori);
    }

    $pendaftarans = $query->latest()->get();

    // Hitung statistik permohonan untuk Admin
    $countSemua     = PendaftaranSimaksi::count();
    $countPending   = PendaftaranSimaksi::whereIn('status', ['pending', 'menunggu_zoom'])->count();
    $countDisetujui = PendaftaranSimaksi::where('status', 'disetujui')->count();
    $countDitolak   = PendaftaranSimaksi::where('status', 'ditolak')->count();

    // Hitung statistik spesifik berdasarkan kategori_pemohon (Menggunakan LIKE)
    // 1. Semua Permohonan
    $countSemuaMahasiswa = PendaftaranSimaksi::where('kategori_pemohon', 'LIKE', 'mahasiswa')->count();
    $countSemuaUmum      = PendaftaranSimaksi::where('kategori_pemohon', 'LIKE', 'umum')->count();

    // 2. Permohonan Masuk (Pending / Menunggu Zoom)
    $countPendingMahasiswa = PendaftaranSimaksi::whereIn('status', ['pending', 'menunggu_zoom'])->where('kategori_pemohon', 'LIKE', 'mahasiswa')->count();
    $countPendingUmum      = PendaftaranSimaksi::whereIn('status', ['pending', 'menunggu_zoom'])->where('kategori_pemohon', 'LIKE', 'umum')->count();

    // 3. Disetujui
    $countDisetujuiMahasiswa = PendaftaranSimaksi::where('status', 'disetujui')->where('kategori_pemohon', 'LIKE', 'mahasiswa')->count();
    $countDisetujuiUmum      = PendaftaranSimaksi::where('status', 'disetujui')->where('kategori_pemohon', 'LIKE', 'umum')->count();

    // 4. Ditolak
    $countDitolakMahasiswa = PendaftaranSimaksi::where('status', 'ditolak')->where('kategori_pemohon', 'LIKE', 'mahasiswa')->count();
    $countDitolakUmum      = PendaftaranSimaksi::where('status', 'ditolak')->where('kategori_pemohon', 'LIKE', 'umum')->count();

    return view('admin_index', compact(
        'pendaftarans',
        'status',
        'kategori',
        'countSemua',
        'countPending',
        'countDisetujui',
        'countDitolak',
        'countSemuaMahasiswa',
        'countSemuaUmum',
        'countPendingMahasiswa',
        'countPendingUmum',
        'countDisetujuiMahasiswa',
        'countDisetujuiUmum',
        'countDitolakMahasiswa',
        'countDitolakUmum'
    ));
}
    // Menyimpan data formulir dan mengunggah dokumen
    public function store(Request $request)
{
    // Letakkan di sini untuk tes data masuk
    //dd($request->all());

    // 1. Validasi Input (Termasuk validasi kategori pemohon dan syarat kolom mahasiswa)
        $request->validate([
            'kategori_pemohon'     => 'required|in:Mahasiswa,Umum,mahasiswa,umum',
            'nim'                  => 'nullable|string|max:50',
            'prodi'                => 'nullable|string|max:100', 
            'fakultas'             => 'nullable|string|max:100',
            'nama_lengkap'         => 'required|string|max:255',
            'nik_nip'              => 'required|string|max:50',
            'alamat'               => 'required|string',
            'tempat_lahir'         => 'required|string|max:100',
            'tanggal_lahir'        => 'required|date',
            'no_hp'                => 'required|string|max:20',
            'asal_instansi'        => 'required|string|max:255',
            'judul_penelitian'     => 'required|string',
            'tujuan_kegiatan'      => 'required|string',
            'tanggal_mulai'        => 'required|date',
            'tanggal_selesai'      => 'required|date',
            'lokasi_penelitian'    => 'required|string|max:255',
            'file_ktp'             => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_surat_pengantar' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_proposal'        => 'required|file|mimes:pdf|max:10240',
        ]);

        // 2. Upload Dokumen ke Folder storage/app/public/dokumen
        $pathKtp       = $request->file('file_ktp')->store('dokumen/ktp', 'public');
        $pathPengantar = $request->file('file_surat_pengantar')->store('dokumen/pengantar', 'public');
        $pathProposal  = $request->file('file_proposal')->store('dokumen/proposal', 'public');

        // 3. Simpan Data ke Database (Menyesuaikan dengan nama kolom database: kategori_pemohon & prodi)
        PendaftaranSimaksi::create([
    'user_id'              => auth()->id(), 
    'kategori_pemohon'     => $request->kategori_pemohon,
    'nim'                  => strtolower($request->kategori_pemohon) == 'mahasiswa' ? $request->nim : null,
    'prodi'                => strtolower($request->kategori_pemohon) == 'mahasiswa' ? $request->prodi : null, 
    'fakultas'             => strtolower($request->kategori_pemohon) == 'mahasiswa' ? $request->fakultas : null,
    'nama_lengkap'         => $request->nama_lengkap,
    'nik_nip'              => $request->nik_nip,
    'alamat'               => $request->alamat,
    'tempat_lahir'         => $request->tempat_lahir,
    'tanggal_lahir'        => $request->tanggal_lahir,
    'no_hp'                => $request->no_hp,
    'asal_instansi'        => $request->asal_instansi,
    'judul_penelitian'     => $request->judul_penelitian,
    'tujuan_kegiatan'      => $request->tujuan_kegiatan,
    'tanggal_mulai'        => $request->tanggal_mulai,
    'tanggal_selesai'      => $request->tanggal_selesai,
    'lokasi_penelitian'    => $request->lokasi_penelitian,
    'file_ktp'             => $pathKtp,
    'file_surat_pengantar' => $pathPengantar,
    'file_proposal'        => $pathProposal,
    'status'               => 'pending',
]);
        return redirect()->back()->with('success', 'Pendaftaran SIMAKSI berhasil dikirim!');
    }

    // 4. Menampilkan Halaman Edit Data Permohonan
    public function edit($id)
    {
        $item = PendaftaranSimaksi::findOrFail($id);
        return view('admin_edit', compact('item'));
    }

    // 5. Memperbarui Data Permohonan (Update)
    public function update(Request $request, $id)
    {
        $item = PendaftaranSimaksi::findOrFail($id);

        $request->validate([
            'kategori_pemohon'     => 'required|in:Mahasiswa,Umum,mahasiswa,umum',
            'nim'                  => 'nullable|string|max:50',
            'prodi'                => 'nullable|string|max:100',
            'fakultas'             => 'nullable|string|max:100',
            'nama_lengkap'         => 'required|string|max:255',
            'nik_nip'              => 'required|string|max:50',
            'alamat'               => 'required|string',
            'tempat_lahir'         => 'required|string|max:100',
            'tanggal_lahir'        => 'required|date',
            'no_hp'                => 'required|string|max:20',
            'asal_instansi'        => 'required|string|max:255',
            'judul_penelitian'     => 'required|string',
            'tujuan_kegiatan'      => 'required|string',
            'tanggal_mulai'        => 'required|date',
            'tanggal_selesai'      => 'required|date',
            'lokasi_penelitian'    => 'required|string|max:255',
            'file_ktp'             => 'nullable|file|mimes:pdf|jpg,jpeg,png|max:5120',
            'file_surat_pengantar' => 'nullable|file|mimes:pdf|jpg,jpeg,png|max:5120',
            'file_proposal'        => 'nullable|file|mimes:pdf|max:10240',
        ]);

        // Cek dan ganti berkas KTP jika diunggah berkas baru
        if ($request->hasFile('file_ktp')) {
            if ($item->file_ktp) {
                Storage::disk('public')->delete($item->file_ktp);
            }
            $item->file_ktp = $request->file('file_ktp')->store('dokumen/ktp', 'public');
        }

        // Cek dan ganti berkas Surat Pengantar jika diunggah berkas baru
        if ($request->hasFile('file_surat_pengantar')) {
            if ($item->file_surat_pengantar) {
                Storage::disk('public')->delete($item->file_surat_pengantar);
            }
            $item->file_surat_pengantar = $request->file('file_surat_pengantar')->store('dokumen/pengantar', 'public');
        }

        // Cek dan ganti berkas Proposal jika diunggah berkas baru
        if ($request->hasFile('file_proposal')) {
            if ($item->file_proposal) {
                Storage::disk('public')->delete($item->file_proposal);
            }
            $item->file_proposal = $request->file('file_proposal')->store('dokumen/proposal', 'public');
        }

        // Update data teks (menyesuaikan dengan kategori_pemohon & prodi)
        $item->update([
            'kategori_pemohon'     => $request->kategori_pemohon,
            'nim'                  => strtolower($request->kategori_pemohon) == 'mahasiswa' ? $request->nim : null,
            'prodi'                => strtolower($request->kategori_pemohon) == 'mahasiswa' ? $request->prodi : null,
            'fakultas'             => strtolower($request->kategori_pemohon) == 'mahasiswa' ? $request->fakultas : null,
            'nama_lengkap'         => $request->nama_lengkap,
            'nik_nip'              => $request->nik_nip,
            'alamat'               => $request->alamat,
            'tempat_lahir'         => $request->tempat_lahir,
            'tanggal_lahir'        => $request->tanggal_lahir,
            'no_hp'                => $request->no_hp,
            'asal_instansi'        => $request->asal_instansi,
            'judul_penelitian'     => $request->judul_penelitian,
            'tujuan_kegiatan'      => $request->tujuan_kegiatan,
            'tanggal_mulai'        => $request->tanggal_mulai,
            'tanggal_selesai'      => $request->tanggal_selesai,
            'lokasi_penelitian'    => $request->lokasi_penelitian,
        ]);

        return redirect()->route('simaksi.admin')->with('success', 'Data permohonan berhasil diperbarui!');
    }

    // 6. Menghapus Data Permohonan dan Berkas Terkait (Destroy)
    public function destroy($id)
    {
        $item = PendaftaranSimaksi::findOrFail($id);

        // Hapus file fisik dari direktori storage jika ada
        if ($item->file_ktp) {
            Storage::disk('public')->delete($item->file_ktp);
        }
        if ($item->file_surat_pengantar) {
            Storage::disk('public')->delete($item->file_surat_pengantar);
        }
        if ($item->file_proposal) {
            Storage::disk('public')->delete($item->file_proposal);
        }
        if ($item->surat_izin) {
            Storage::disk('public')->delete($item->surat_izin);
        }

        // Hapus record dari database
        $item->delete();

        return redirect()->route('simaksi.admin')->with('success', 'Data permohonan berhasil dihapus!');
    }
    // Method untuk memperbarui status, link zoom, dan jadwal konsultasi oleh admin
    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status'         => 'required|string',
        'link_zoom'      => 'nullable|string',
        'tanggal_zoom'   => 'nullable',
        'surat_izin'     => 'nullable|file|mimes:pdf|max:2048', // Validasi file PDF
        'catatan_admin'  => 'nullable|string',                 // Validasi teks catatan
    ]);

    $item = PendaftaranSimaksi::findOrFail($id);

    $item->status = $request->status;
    
    if ($request->has('link_zoom')) {
        $item->link_zoom = $request->link_zoom;
    }
    
    if ($request->has('tanggal_zoom')) {
        $item->tanggal_zoom = $request->tanggal_zoom;
    }

    // Simpan catatan_admin jika dikirim
    if ($request->has('catatan_admin')) {
        $item->catatan_admin = $request->catatan_admin;
    }

    // Proses upload file surat_izin jika ada file yang dikirim
    if ($request->hasFile('surat_izin')) {
        // Hapus file lama jika ada untuk menghemat ruang
        if ($item->surat_izin && \Storage::disk('public')->exists($item->surat_izin)) {
            \Storage::disk('public')->delete($item->surat_izin);
        }

        // Simpan file baru ke folder public/storage/surat_izin
        $path = $request->file('surat_izin')->store('surat_izin', 'public');
        $item->surat_izin = $path;
    }
    
    $item->save();

    return redirect()->back()->with('success', 'Status, surat izin, dan catatan berhasil diperbarui!');
}

    // Method untuk Mengunduh File PDF Surat Izin dari Admin
    public function downloadPdf($id)
    {
        $simaksi = PendaftaranSimaksi::where('user_id', auth()->id())->findOrFail($id);

        // Cek apakah admin sudah mengunggah file surat izin
        if (!$simaksi->surat_izin || !Storage::disk('public')->exists($simaksi->surat_izin)) {
            return back()->with('error', 'File surat izin belum diunggah oleh admin.');
        }

        // Download file PDF langsung dari storage
        return Storage::disk('public')->download($simaksi->surat_izin, 'Surat-Izin-SIMAKSI-' . $simaksi->nama_lengkap . '.pdf');
    }

    public function exportData(Request $request)
    {
        $kategori = $request->get('kategori', 'semua');
        $periodeMulai = $request->get('periode_mulai');
        $periodeSelesai = $request->get('periode_selesai');
        $format = $request->get('format'); // Jika ada parameter format, berarti user mendownload file

        $query = PendaftaranSimaksi::query();

        // Filter Kategori (Semua status: pending, disetujui/sukses, ditolak akan masuk)
        if ($kategori !== 'semua') {
            $query->where('kategori_pemohon', 'LIKE', $kategori);
        }

        // Filter Rentang Waktu (Bulan & Tahun)
        if ($periodeMulai && $periodeSelesai) {
            $dateMulai = $periodeMulai . '-01 00:00:00';
            $dateSelesai = date('Y-m-t 23:59:59', strtotime($periodeSelesai . '-01'));
            $query->whereBetween('created_at', [$dateMulai, $dateSelesai]);
        }

        $data = $query->latest()->get();

        // 1. Jika parameter format bernilai excel atau pdf, lakukan proses download file
        if ($format === 'excel') {
            $view = view('export_excel', compact('data', 'kategori', 'periodeMulai', 'periodeSelesai'))->render();
            $filename = 'Laporan_SIMAKSI_' . strtoupper($kategori) . '_' . $periodeMulai . '_sd_' . $periodeSelesai . '.xls';

            return response($view)
                ->header('Content-Type', 'application/vnd.ms-excel')
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
        }
        
        if ($format === 'pdf') {
            $view = view('export_pdf', compact('data', 'kategori', 'periodeMulai', 'periodeSelesai'))->render();
            $filename = 'Laporan_SIMAKSI_' . strtoupper($kategori) . '_' . $periodeMulai . '_sd_' . $periodeSelesai . '.pdf';

            return response($view)->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
        }

        // 2. Jika tidak ada format yang dipilih, arahkan ke halaman preview terlebih dahulu agar BKSDA bisa melihat datanya
        return view('admin_preview_laporan', compact('data', 'kategori', 'periodeMulai', 'periodeSelesai'));
    }
}