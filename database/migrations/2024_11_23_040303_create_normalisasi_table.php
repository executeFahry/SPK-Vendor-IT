<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNormalisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('normalisasi', function (Blueprint $table) {
            $table->id('id_normalisasi'); // Primary Key
            $table->integer('id_alternatif'); // Foreign Key ke Alternatif
            $table->integer('id_kriteria'); // Foreign Key ke Kriteria
            $table->decimal('nilai_normalisasi', 8, 4); // Nilai normalisasi

            // Foreign key constraints
            $table->foreign('id_alternatif')->references('id_alternatif')->on('data_alternatif')->onDelete('cascade');
            $table->foreign('id_kriteria')->references('id_kriteria')->on('data_kriteria')->onDelete('cascade');
        });
    }

    public $timestamps = false;

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('normalisasi');
    }
}
