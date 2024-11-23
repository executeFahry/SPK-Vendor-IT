<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Normalisasi;

class RankingController extends Controller
{
    public function index()
    {
        // Ambil data normalisasi
        $normalisasi = Normalisasi::with('alternatif', 'kriteria')->get();

        // Kelompokkan data berdasarkan alternatif
        $groupedData = $normalisasi->groupBy('id_alternatif');

        $rankingData = [];
        $totalSi = 0;

        // Hitung nilai Si untuk setiap alternatif
        foreach ($groupedData as $idAlternatif => $data) {
            $nilaiSi = $data->reduce(function ($carry, $item) {
                return $carry * $item->nilai_normalisasi;
            }, 1);

            $rankingData[$idAlternatif] = [
                'kode_alternatif' => $data->first()->alternatif->kode_alternatif,
                'nama_vendor' => $data->first()->alternatif->nama_vendor,
                'nilai_si' => $nilaiSi,
            ];

            $totalSi += $nilaiSi;
        }

        // Hitung nilai preferensi (Vi)
        foreach ($rankingData as &$item) {
            $item['nilai_preferensi'] = $item['nilai_si'] / $totalSi;
        }

        // Urutkan berdasarkan nilai preferensi (Vi) secara menurun
        usort($rankingData, function ($a, $b) {
            return $b['nilai_preferensi'] <=> $a['nilai_preferensi'];
        });

        // Tambahkan ranking berdasarkan urutan
        foreach ($rankingData as $index => &$item) {
            $item['rank'] = $index + 1;
        }

        // Ambil vendor dengan nilai tertinggi
        $topVendor = $rankingData[0];

        return view('ranking.list', compact('rankingData', 'topVendor'));
    }
}
