@extends('layout')

@section('title', 'Ranking')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title">Hasil Perankingan</h4>
                    </div>
                    <div class="card-body">
                        @if (!empty($rankingData) && count($rankingData) > 0)
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>Kode Alternatif</th>
                                        <th>Nama Vendor</th>
                                        <th>Nilai Preferensi (V<sub>i</sub>)</th>
                                        <th>Rank</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rankingData as $data)
                                        <tr class="text-center">
                                            <td>{{ $data['kode_alternatif'] }}</td>
                                            <td>{{ $data['nama_vendor'] }}</td>
                                            <td>{{ number_format($data['nilai_preferensi'], 4) }}</td>
                                            <td>{{ $data['rank'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4">
                                <h5 class="text-center fw-bold">Kesimpulan:</h5>
                                <p class="text-center">
                                    Vendor IT yang terpilih untuk mengerjakan proyek perusahaan adalah
                                    <strong>{{ $topVendor['nama_vendor'] }}</strong>
                                    dengan nilai tertinggi sebesar
                                    <strong>{{ number_format($topVendor['nilai_preferensi'], 4) }}</strong>.
                                </p>
                            </div>
                        @else
                            <div class="alert alert-warning text-center">
                                Data ranking tidak tersedia. Pastikan Anda telah melakukan proses normalisasi.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
