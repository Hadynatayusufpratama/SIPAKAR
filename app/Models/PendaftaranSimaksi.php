<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranSimaksi extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_simaksi'; // Sesuaikan dengan nama tabel hasil migrate

    protected $fillable = [
        'user_id',
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
        'file_ktp',
        'file_surat_pengantar',
        'file_proposal',
        'status',
        'tanggal_zoom',     // Tambahan baru
        'link_zoom',        // Tambahan baru
        'surat_izin',       // Tambahan baru
        'catatan_admin',    // Tambahan baru
    ];
}