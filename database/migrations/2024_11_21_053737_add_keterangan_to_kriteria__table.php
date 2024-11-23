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
        Schema::table('data_kriteria', function (Blueprint $table) {
            if (!Schema::hasColumn('data_kriteria', 'keterangan')) {
                $table->enum('keterangan', ['cost', 'benefit'])->default('benefit')->after('nilai_bobot');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_kriteria', function (Blueprint $table) {
            if (Schema::hasColumn('data_kriteria', 'keterangan')) {
                $table->dropColumn('keterangan');
            }
        });
    }
};
