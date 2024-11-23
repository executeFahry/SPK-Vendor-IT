<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function dashboard()
    {
        $totalAlternatif = Alternatif::count();
        $totalKriteria = Kriteria::count();
        return view('dashboard', compact('totalAlternatif', 'totalKriteria'));
    }
}
