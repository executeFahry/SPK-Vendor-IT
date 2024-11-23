<?php

namespace App\Http\Controllers;

use App\Models\Normalisasi;
use App\Models\MatriksKeputusan;
use App\Models\Kriteria;

class NormalisasiController extends Controller
{
    public function hitung()
    {
        $matriks = MatriksKeputusan::all();
        $kriterias = Kriteria::all();

        // Kosongkan tabel normalisasi sebelum mengisi data baru
        Normalisasi::truncate();

        // Menghitung nilai normalisasi (Si) dari matriks keputusan
        foreach ($matriks->groupBy('id_alternatif') as $idAlternatif => $nilaiKriteria) {
            foreach ($nilaiKriteria as $nilai) {
                $kriteria = $kriterias->find($nilai->id_kriteria);

                // Perhitungan normalisasi (Cij^Wj)
                $normalisasi = pow($nilai->nilai_rating, $kriteria->nilai_bobot);

                // Simpan hasil ke tabel normalisasi
                Normalisasi::create([
                    'id_alternatif' => $idAlternatif,
                    'id_kriteria' => $nilai->id_kriteria,
                    'nilai_normalisasi' => $normalisasi
                ]);
            }
        }

        // Redirect ke halaman hasil normalisasi
        return redirect()->route('normalisasi.hasil')->with('success', 'Normalisasi berhasil dihitung dan disimpan.');
    }

    public function hasil()
    {
        $hasilNormalisasi = Normalisasi::with(['alternatif', 'kriteria'])
            ->get()
            ->groupBy('id_alternatif');

        return view('normalisasi.hasil', compact('hasilNormalisasi'));
    }
}
