<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\AlternatifKriteria;
use Illuminate\Support\Facades\DB;

class AlternatifKriteriaController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::with('kriterias')->get();
        $kriterias = Kriteria::all();

        return view('matriks.list', compact('alternatifs', 'kriterias'));
    }

    public function generateMatriks()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();

        foreach ($alternatifs as $alternatif) {
            foreach ($kriterias as $kriteria) {
                AlternatifKriteria::updateOrCreate(
                    [
                        'id_alternatif' => $alternatif->id_alternatif,
                        'id_kriteria' => $kriteria->id_kriteria,
                    ],
                    [
                        'nilai_rating' => 0, // Default nilai
                    ]
                );
            }
        }

        return redirect()->route('matriks.index')->with('success', 'Matriks keputusan berhasil di-generate');
    }

    public function normalisasi()
    {
        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::with('kriterias')->get();

        $hasilNormalisasi = [];

        foreach ($kriterias as $kriteria) {
            $maxValue = DB::table('alternatif_kriteria')
                ->where('id_kriteria', $kriteria->id_kriteria)
                ->max('nilai_rating');

            foreach ($alternatifs as $alternatif) {
                $pivot = $alternatif->kriterias->where('id_kriteria', $kriteria->id_kriteria)->first();
                if ($pivot) {
                    $nilaiNormalisasi = $maxValue > 0 ? $pivot->pivot->nilai_rating / $maxValue : 0;

                    $hasilNormalisasi[$alternatif->id_alternatif][] = [
                        'alternatif' => $alternatif,
                        'kriteria' => $kriteria,
                        'nilai_normalisasi' => $nilaiNormalisasi,
                    ];
                }
            }
        }

        return view('normalisasi.hasil', compact('hasilNormalisasi'));
    }
}
