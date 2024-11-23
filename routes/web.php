<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifKriteriaController;
use App\Http\Controllers\NormalisasiController;
use App\Http\Controllers\RankingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home Routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

// Alternatif Routes
Route::resource('alternatif', AlternatifController::class);

// Kriteria Routes
Route::resource('kriteria', KriteriaController::class)->parameters([
    'kriteria' => 'kriteria' // gunakan 'kriteria' sebagai parameter
]);

// Matriks Keputusan Routes
Route::resource('matriks', AlternatifKriteriaController::class)->parameters([
    'matriks' => 'matriks' // Menggunakan 'matriks' sebagai parameter
])->except('show');

// Generate Matriks Keputusan
Route::post('/matriks/generate', [AlternatifKriteriaController::class, 'generateMatriks'])->name('matriks.generate');

// Normalisasi Routes
Route::get('/normalisasi/hitung', [NormalisasiController::class, 'hitung'])->name('normalisasi.hitung');
Route::get('/normalisasi/hasil', [NormalisasiController::class, 'hasil'])->name('normalisasi.hasil');

// Ranking Routes
Route::get('/ranking', [RankingController::class, 'index'])->name('ranking.index');
