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
        Schema::table('data_alternatif', function (Blueprint $table) {
            $table->string('kode_alternatif', 4)->after('id_alternatif');
            $table->string('pengalaman_proyek', 50)->after('nama_vendor');
            $table->string('kualitas_layanan', 50)->after('pengalaman_proyek');
            $table->string('keamanan_layanan', 50)->after('kualitas_layanan');
            $table->string('keahlian_teknis', 50)->after('keamanan_layanan');
            $table->string('keterlibatan_tim', 50)->after('keahlian_teknis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_alternatif', function (Blueprint $table) {
            $table->dropColumn([
                'kode_alternatif',
                'pengalaman_proyek',
                'kualitas_layanan',
                'keamanan_layanan',
                'keahlian_teknis',
                'keterlibatan_tim'
            ]);
        });
    }
};
