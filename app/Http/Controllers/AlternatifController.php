<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\MatriksKeputusan;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::paginate(10);
        $kriterias = Kriteria::all();
        return view('alternatif.list', compact('alternatifs', 'kriterias'));
    }

    public function create()
    {
        return view('alternatif.formTambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_alternatif' => 'required|string|max:4|unique:data_alternatif,kode_alternatif',
            'nama_vendor' => 'required|string|max:150',
            'pengalaman_proyek' => 'required|numeric',
            'kualitas_layanan' => 'required|string|in:Tidak Baik,Cukup Baik,Baik,Sangat Baik',
            'keamanan_layanan' => 'required|string|in:Tidak Baik,Cukup Baik,Baik,Sangat Baik',
            'keahlian_teknis' => 'required|string|in:Tidak Baik,Cukup Baik,Baik,Sangat Baik',
            'keterlibatan_tim' => 'required|string|in:Tidak Baik,Cukup Baik,Baik,Sangat Baik',
        ]);


        $alternatif = Alternatif::create($request->all());

        // Field mapping untuk kriteria
        $fieldMapping = [
            'C1' => 'pengalaman_proyek',
            'C2' => 'kualitas_layanan',
            'C3' => 'keamanan_layanan',
            'C4' => 'keahlian_teknis',
            'C5' => 'keterlibatan_tim',
        ];

        // Mapping untuk nilai bobot kepentingan
        $bobotKepentingan = [
            'Tidak Baik' => 1,
            'Cukup Baik' => 2,
            'Baik' => 3,
            'Sangat Baik' => 4,
        ];

        // Generate Matriks Keputusan
        $kriterias = Kriteria::all();

        foreach ($kriterias as $kriteria) {
            $field = $fieldMapping[$kriteria->kode_kriteria] ?? null;
            $nilaiRating = 0;

            if ($field) {
                if ($kriteria->kode_kriteria === 'C1') {
                    // Ambil nilai langsung untuk C1
                    $nilaiRating = $alternatif->{$field};
                } else {
                    // Ambil kategori dan mapping ke nilai bobot
                    $kategori = $alternatif->{$field} ?? null;
                    $nilaiRating = $kategori && isset($bobotKepentingan[$kategori])
                        ? $bobotKepentingan[$kategori]
                        : 0;
                }
            }

            MatriksKeputusan::create([
                'id_alternatif' => $alternatif->id_alternatif,
                'id_kriteria' => $kriteria->id_kriteria,
                'nilai_rating' => $nilaiRating, // Ambil nilai rating kategori
            ]);
        }

        return redirect()->route('alternatif.index')->with('success', 'Data alternatif berhasil ditambahkan');
    }

    public function edit(Alternatif $alternatif)
    {
        return view('alternatif.formEdit', compact('alternatif'));
    }

    public function update(Request $request, Alternatif $alternatif)
    {

        $request->validate([
            'kode_alternatif' => 'required|string|max:4|unique:data_alternatif,kode_alternatif,' . $alternatif->id_alternatif . ',id_alternatif',
            'nama_vendor' => 'required|string|max:150',
            'pengalaman_proyek' => 'required|numeric',
            'kualitas_layanan' => 'required|string|max:50',
            'keamanan_layanan' => 'required|string|max:50',
            'keahlian_teknis' => 'required|string|max:50',
            'keterlibatan_tim' => 'required|string|max:50',
        ]);

        // Update data alternatif
        $alternatif->update($request->all());

        // Mapping untuk nilai bobot kepentingan
        $bobotKepentingan = [
            'Tidak Baik' => 1,
            'Cukup Baik' => 2,
            'Baik' => 3,
            'Sangat Baik' => 4,
        ];

        // Update Matriks Keputusan Otomatis
        $kriterias = Kriteria::all();
        $fieldMapping = [
            'C1' => 'pengalaman_proyek',
            'C2' => 'kualitas_layanan',
            'C3' => 'keamanan_layanan',
            'C4' => 'keahlian_teknis',
            'C5' => 'keterlibatan_tim',
        ];

        foreach ($kriterias as $kriteria) {
            $field = $fieldMapping[$kriteria->kode_kriteria] ?? null;

            if ($field) {
                if ($kriteria->kode_kriteria === 'C1') {
                    $nilaiRating = $alternatif->{$field}; // Ambil nilai langsung untuk C1
                } else {
                    $kategori = $alternatif->{$field} ?? null;
                    $nilaiRating = $kategori && isset($bobotKepentingan[$kategori])
                        ? $bobotKepentingan[$kategori]
                        : 0; // Default jika kategori tidak valid
                }

                // Update nilai pada matriks keputusan
                MatriksKeputusan::updateOrCreate(
                    [
                        'id_alternatif' => $alternatif->id_alternatif,
                        'id_kriteria' => $kriteria->id_kriteria,
                    ],
                    ['nilai_rating' => $nilaiRating]
                );
            }
        }

        return redirect()->route('alternatif.index')->with('success', 'Data alternatif dan matriks keputusan berhasil diperbarui');
    }

    public function destroy(Alternatif $alternatif)
    {
        // Hapus Matriks Keputusan terkait Alternatif
        MatriksKeputusan::where('id_alternatif', $alternatif->id_alternatif)->delete();
        $alternatif->delete();

        return redirect()->route('alternatif.index')->with('success', 'Data alternatif berhasil dihapus');
    }
}
