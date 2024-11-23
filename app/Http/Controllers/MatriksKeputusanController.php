<?php

namespace App\Http\Controllers;

use App\Models\MatriksKeputusan;
use App\Models\Alternatif;
use App\Models\Kriteria;

class MatriksKeputusanController extends Controller
{
    public function index()
    {
        $matriks = MatriksKeputusan::with('alternatif', 'kriteria')->get();
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        return view('matriks.list', compact('matriks', 'alternatifs', 'kriterias'));
    }

    public function normalisasi()
    {
        return redirect()->route('normalisasi.hitung');
    }
}
