<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftaran_simaksi', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    
    // Tambahkan baris ini untuk kategori dan data mahasiswa:
    $table->string('kategori_pemohon')->nullable();
    $table->string('nim')->nullable();
    $table->string('prodi')->nullable();
    $table->string('fakultas')->nullable();

    // 1. Data Pemohon
    $table->string('nama_lengkap');
    $table->string('nik_nip');
    $table->text('alamat');
    $table->string('tempat_lahir');
    $table->date('tanggal_lahir');
    $table->string('no_hp');
    $table->string('asal_instansi');

    // 2. Detail Penelitian / Kegiatan
    $table->text('judul_penelitian');
    $table->text('tujuan_kegiatan');
    $table->date('tanggal_mulai');
    $table->date('tanggal_selesai');
    $table->string('lokasi_penelitian');

    // 3. Upload Dokumen
    $table->string('file_ktp')->nullable();
    $table->string('file_surat_pengantar')->nullable();
    $table->string('file_proposal')->nullable();

    // 4. Status Pengajuan & Kolom Tambahan
    $table->enum('status', ['pending', 'menunggu_zoom', 'disetujui', 'ditolak'])->default('pending');
    $table->dateTime('tanggal_zoom')->nullable();
    $table->string('link_zoom')->nullable();
    $table->text('catatan_admin')->nullable();
    $table->string('surat_izin')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_simaksi');
    }
};