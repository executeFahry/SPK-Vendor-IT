<?php

namespace App\Http\Controllers;

use App\Models\Normalisasi;
use App\Models\AlternatifKriteria;
use App\Models\Kriteria;

class NormalisasiController extends Controller
{
    public function hitung()
    {
        $matriks = AlternatifKriteria::with('kriteria', 'alternatif')->get();
        $kriterias = Kriteria::all();

        // Kosongkan tabel normalisasi sebelum mengisi data baru
        Normalisasi::truncate();

        // Perhitungan normalisasi
        foreach ($matriks->groupBy('id_alternatif') as $idAlternatif => $nilaiKriteria) {
            foreach ($nilaiKriteria as $nilai) {
                $kriteria = $kriterias->find($nilai->id_kriteria);

                if ($kriteria) {
                    // Tentukan jenis kriteria (Benefit atau Cost)
                    $bobot = $kriteria->keterangan === 'cost' ? -$kriteria->nilai_bobot : $kriteria->nilai_bobot;

                    // Perhitungan normalisasi (Cij^Wj untuk Benefit, atau Cij^-Wj untuk Cost)
                    $normalisasi = pow($nilai->nilai_rating, $bobot);

                    // Simpan hasil normalisasi
                    Normalisasi::create([
                        'id_alternatif' => $idAlternatif,
                        'id_kriteria' => $nilai->id_kriteria,
                        'nilai_normalisasi' => $normalisasi
                    ]);
                }
            }
        }

        // Redirect ke halaman hasil normalisasi
        return redirect()->route('normalisasi.hasil')->with('success', 'Normalisasi dengan Benefit dan Cost berhasil dihitung.');
    }



    public function hasil()
    {
        $hasilNormalisasi = Normalisasi::with(['alternatif', 'kriteria'])
            ->get()
            ->groupBy('id_alternatif');

        $kriterias = Kriteria::all();

        return view('normalisasi.hasil', compact('hasilNormalisasi', 'kriterias'));
    }
}
