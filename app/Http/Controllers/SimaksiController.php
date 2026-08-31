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
        $totalPending    = PendaftaranSimaksi::where('user_id', $userId)->where('status', 'pending')->count();
        $totalDisetujui  = PendaftaranSimaksi::where('user_id', $userId)->where('status', 'disetujui')->count();
        $totalPermohonan = PendaftaranSimaksi::where('user_id', $userId)->count();

        return view('pendaftaran', compact('permohonan', 'totalPending', 'totalDisetujui', 'totalPermohonan'));
    }

    // Menampilkan daftar seluruh pemohon SIMAKSI untuk Admin BKSDA (Diupdate dengan Filter & Statistik)
    public function adminIndex(Request $request)
    {
        $status = $request->query('status', 'semua');

        // Query dasar
        $query = PendaftaranSimaksi::orderBy('created_at', 'desc');

        if ($status !== 'semua') {
            $query->where('status', $status);
        }

        $pendaftarans = $query->get();

        // Hitung statistik permohonan untuk Admin (Mencegah error Undefined Variable di View)
        $countSemua     = PendaftaranSimaksi::count();
        $countPending   = PendaftaranSimaksi::where('status', 'pending')->count();
        $countDisetujui = PendaftaranSimaksi::where('status', 'disetujui')->count();
        $countDitolak   = PendaftaranSimaksi::where('status', 'ditolak')->count();

        return view('admin_index', compact(
            'pendaftarans',
            'status',
            'countSemua',
            'countPending',
            'countDisetujui',
            'countDitolak'
        ));
    }

    // Method untuk mengubah status permohonan & mengatur Jadwal Zoom oleh Admin
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status'        => 'required|in:pending,disetujui,ditolak,menunggu_zoom',
            'zoom_schedule' => 'nullable|date',
            'zoom_link'     => 'nullable|string|max:255',
            'catatan_admin' => 'nullable|string',
            'surat_izin'    => 'nullable|file|mimes:pdf|max:2048', 
        ]);

        $item = PendaftaranSimaksi::findOrFail($id);

        // 1. Ambil status dasar dari inputan form admin terlebih dahulu
$item->status = $request->status;

if ($request->has('tanggal_zoom') && $request->tanggal_zoom) {
    $item->tanggal_zoom = $request->tanggal_zoom; 
    $item->link_zoom = $request->link_zoom;
    $item->status = 'menunggu_zoom';
}

        if ($request->has('catatan_admin')) {
            $item->catatan_admin = $request->catatan_admin;
        }

        // 3. Jika admin mengunggah file surat izin, pastikan status jadi disetujui
        if ($request->hasFile('surat_izin')) {
            if ($item->surat_izin) {
                Storage::disk('public')->delete($item->surat_izin);
            }
            $item->surat_izin = $request->file('surat_izin')->store('dokumen/surat_izin', 'public');
            $item->status = 'disetujui';
        }

        $item->save();

        $pesan = 'Status permohonan berhasil diperbarui!';
        if ($item->status == 'disetujui') {
            $pesan = 'Permohonan disetujui dan surat izin resmi berhasil diunggah!';
        } elseif ($item->status == 'menunggu_zoom') {
            $pesan = 'Jadwal Zoom dan presentasi berhasil diatur oleh admin!';
        } elseif ($item->status == 'ditolak') {
            $pesan = 'Permohonan telah ditolak.';
        }

        return redirect()->back()->with('success', $pesan);
    }
    // Menyimpan data formulir dan mengunggah dokumen
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
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

        // 3. Simpan Data ke Database (Menambahkan user_id akun yang sedang login)
        PendaftaranSimaksi::create([
            'user_id'              => auth()->id(), // <--- Menyimpan ID user yang sedang login
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
            'file_ktp'             => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_surat_pengantar' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
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

        // Update data teks
        $item->update($request->only([
            'nama_lengkap',
            'nik_nip',
            'alamat',
            'tempat_lahir',
            'tanggal_lahir',
            'no_hp',
            'asal_instansi',
            'judul_penelitian',
            'tujuan_kegiatan',
            'tanggal_mulai',
            'tanggal_selesai',
            'lokasi_penelitian',
        ]));

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
}