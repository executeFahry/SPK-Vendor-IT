<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

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
            'kode_kriteria' => 'required|string|max:4|unique:data_kriteria,kode_kriteria',
            'nama_kriteria' => 'required|string|max:150',
            'nilai_bobot' => 'required|numeric',
            'keterangan' => 'required|in:cost,benefit',
        ]);

        $kriteria = Kriteria::create($validatedData);

        // Tambahkan kriteria baru ke semua alternatif yang ada dengan nilai default
        $alternatifs = \App\Models\Alternatif::all(); // Ambil semua alternatif
        foreach ($alternatifs as $alternatif) {
            $alternatif->kriterias()->attach($kriteria->id_kriteria, ['nilai_rating' => 0]); // Nilai default 0
        }

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
            'kode_kriteria' => 'required|string|max:4|unique:data_kriteria,kode_kriteria,' . $kriteria->id_kriteria . ',id_kriteria',
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
        // Hapus relasi pada tabel alternatif_kriteria
        $kriteria->alternatifs()->detach();

        // Hapus kriteria
        $kriteria->delete();

        return redirect()->route('kriteria.index')->with('success', 'Data kriteria berhasil dihapus');
    }
}
