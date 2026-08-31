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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap')->nullable();
            $table->string('nik_nip')->nullable();
            $table->string('asal_instansi')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('judul_penelitian')->nullable();
            $table->string('lokasi_penelitian')->nullable();
            $table->string('status')->default('pending')->nullable();
            $table->dateTime('tanggal_zoom')->nullable();
            $table->string('link_zoom')->nullable();
            $table->string('surat_izin')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};