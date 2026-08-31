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

            // 3. Upload Dokumen (Penyimpanan path file di server)
            $table->string('file_ktp');
            $table->string('file_surat_pengantar');
            $table->string('file_proposal');

            // 4. Status Pengajuan & Kolom Tambahan untuk Alur BKSDA (Zoom & Presentasi)
            $table->enum('status', ['pending', 'menunggu_zoom', 'disetujui', 'ditolak'])->default('pending');
            $table->dateTime('tanggal_zoom')->nullable(); // <--- Tambahan untuk jadwal Zoom/Presentasi
            $table->string('link_zoom')->nullable();      // <--- Tambahan untuk link Zoom
            $table->text('catatan_admin')->nullable();    // <--- Tambahan untuk catatan SOP/revisi dari admin
            
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