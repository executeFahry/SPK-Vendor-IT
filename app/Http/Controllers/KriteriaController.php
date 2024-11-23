<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\MatriksKeputusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriterias = Kriteria::paginate(10);
        return view('kriteria.list', compact('kriterias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kriteria.formTambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_kriteria' => 'required|string|max:4',
            'nama_kriteria' => 'required|string|max:150',
            'nilai_bobot' => 'required|numeric',
            'keterangan' => 'required|in:cost,benefit',
        ]);

        Log::info('Data setelah validasi:', $validatedData); // Debug setelah validasi
        // 
        Kriteria::create($validatedData);
        return redirect()->route('kriteria.index')->with('success', 'Data kriteria berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kriteria $kriteria)
    {
        return view('kriteria.formEdit', compact('kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kriteria $kriteria)
    {
        $validatedData = $request->validate([
            'kode_kriteria' => 'required|string|max:4',
            'nama_kriteria' => 'required|string|max:150',
            'nilai_bobot' => 'required|numeric',
            'keterangan' => 'required|in:cost,benefit',
        ]);

        $kriteria->update($validatedData);
        return redirect()->route('kriteria.index')->with('success', 'Data kriteria berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Kriteria $kriteria)
    {
        // Hapus Matriks Keputusan terkait Kriteria
        MatriksKeputusan::where('id_kriteria', $kriteria->id_kriteria)->delete();
        $kriteria->delete();

        return redirect()->route('kriteria.index')->with('success', 'Data kriteria berhasil dihapus');
    }
}
