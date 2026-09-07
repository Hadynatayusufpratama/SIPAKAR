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
        Schema::table('pendaftaran_simaksi', function (Blueprint $table) {
            if (!Schema::hasColumn('pendaftaran_simaksi', 'nim')) {
                $table->string('nim')->nullable()->after('nik_nip');
            }
            if (!Schema::hasColumn('pendaftaran_simaksi', 'prodi')) {
                $table->string('prodi')->nullable()->after('asal_instansi');
            }
            if (!Schema::hasColumn('pendaftaran_simaksi', 'fakultas')) {
                $table->string('fakultas')->nullable()->after('prodi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran_simaksi', function (Blueprint $table) {
            $table->dropColumn(['nim', 'prodi', 'fakultas']);
        });
    }
};