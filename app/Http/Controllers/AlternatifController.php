<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::with('kriterias')->paginate(10);
        $kriterias = Kriteria::all();
        return view('alternatif.list', compact('alternatifs', 'kriterias'));
    }

    public function create()
    {
        $kriterias = Kriteria::all();
        return view('alternatif.formTambah', compact('kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_alternatif' => 'required|string|max:4|unique:data_alternatif,kode_alternatif',
            'nama_vendor' => 'required|string|max:150',
            'kriteria.*' => 'required',
        ]);

        try {
            // Tangkap data dari input form
            $input = $request->all();

            // Simpan data utama alternatif
            $alternatif = Alternatif::create([
                'kode_alternatif' => $input['kode_alternatif'],
                'nama_vendor' => $input['nama_vendor'],
                'pengalaman_proyek' => $input['kriteria'][22],
                'kualitas_layanan' => $input['kriteria'][23],
                'keamanan_layanan' => $input['kriteria'][24],
                'keahlian_teknis' => $input['kriteria'][25],
                'keterlibatan_tim' => $input['kriteria'][26],
            ]);

            // Proses kriteria untuk tabel pivot
            $kriterias = Kriteria::all();
            $this->processKriteria($alternatif, $kriterias, $input);

            return redirect()->route('alternatif.index')->with('success', 'Data alternatif berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit(Alternatif $alternatif)
    {
        $kriterias = Kriteria::all();
        return view('alternatif.formEdit', compact('alternatif', 'kriterias'));
    }
    public function update(Request $request, Alternatif $alternatif)
    {
        $request->validate([
            'kode_alternatif' => 'required|string|max:4|unique:data_alternatif,kode_alternatif,' . $alternatif->id_alternatif . ',id_alternatif',
            'nama_vendor' => 'required|string|max:150',
            'kriteria.*' => 'required', // Validasi semua kriteria
        ]);

        try {
            // Update data utama alternatif
            $alternatif->update([
                'kode_alternatif' => $request->input('kode_alternatif'),
                'nama_vendor' => $request->input('nama_vendor'),
            ]);

            // Panggil processKriteria untuk memproses kriteria
            $kriterias = Kriteria::all();
            $this->processKriteria($alternatif, $kriterias, $request->all());

            return redirect()->route('alternatif.index')->with('success', 'Data alternatif dan matriks keputusan berhasil diperbarui');
        } catch (\Exception $e) {
            // Log error jika terjadi masalah
            Log::error('Error saat mengupdate data alternatif', ['error' => $e->getMessage()]);
            return redirect()->back()->withInput()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Alternatif $alternatif)
    {
        // Hapus relasi pada tabel alternatif_kriteria
        $alternatif->kriterias()->detach();

        // Hapus data alternatif
        $alternatif->delete();

        return redirect()->route('alternatif.index')->with('success', 'Data alternatif berhasil dihapus');
    }

    private function processKriteria(Alternatif $alternatif, $kriterias, $data)
    {
        $bobotKepentingan = [
            'Tidak Baik' => 1,
            'Cukup Baik' => 2,
            'Baik' => 3,
            'Sangat Baik' => 4,
        ];

        foreach ($kriterias as $kriteria) {
            try {
                $fieldValue = $data['kriteria'][$kriteria->id_kriteria] ?? null;
                $nilaiRating = 0;

                if ($kriteria->kode_kriteria === 'C1') {
                    // Penanganan khusus untuk "Pengalaman Menangani Proyek IT"
                    $nilaiRating = is_numeric($fieldValue) ? (float) $fieldValue : 0;
                } elseif ($kriteria->keterangan === 'cost' || $kriteria->keterangan === 'benefit') {
                    // Kriteria berbasis kategori
                    $nilaiRating = isset($bobotKepentingan[$fieldValue])
                        ? $bobotKepentingan[$fieldValue]
                        : 0;
                } else {
                    // Kriteria lain (jika ada jenis lainnya)
                    $nilaiRating = is_numeric($fieldValue) ? (float) $fieldValue : 0;
                }

                // Sinkronisasi ke pivot table
                $alternatif->kriterias()->syncWithoutDetaching([
                    $kriteria->id_kriteria => ['nilai_rating' => $nilaiRating],
                ]);
            } catch (\Exception $e) {
                // Tangkap error dan log untuk debugging
                Log::error('Gagal Memproses Kriteria ' . $kriteria->id_kriteria, ['error' => $e->getMessage()]);
            }
        }
    }
}
