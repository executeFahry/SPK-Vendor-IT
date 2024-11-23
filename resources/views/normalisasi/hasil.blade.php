@extends('layout')

@section('title', 'Hasil Normalisasi Bobot')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Hasil Normalisasi Bobot Kriteria</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>Alternatif</th>
                                    @foreach ($hasilNormalisasi->first()->pluck('kriteria') as $kriteria)
                                        <th>{{ $kriteria['kode_kriteria'] }}<sup>{{ $kriteria['nilai_bobot'] }}</sup></th>
                                    @endforeach
                                    <th>Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hasilNormalisasi as $idAlternatif => $data)
                                    <tr>
                                        <td class="text-center">{{ $data->first()->alternatif->kode_alternatif }}</td>
                                        @php
                                            $hasil = 1;
                                        @endphp
                                        @foreach ($data as $nilai)
                                            <td class="text-center">{{ number_format($nilai->nilai_normalisasi, 3) }}</td>
                                            @php
                                                $hasil *= $nilai->nilai_normalisasi;
                                            @endphp
                                        @endforeach
                                        <td class="text-center">{{ number_format($hasil, 3) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
