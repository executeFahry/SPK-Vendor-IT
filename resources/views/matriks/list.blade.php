@extends('layout')

@section('title', 'Matriks Keputusan')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <a href="{{ route('normalisasi.hitung') }}"
                            class="btn btn-primary btn-sm float-end me-2">Normalisasi</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>Alternatif</th>
                                    @foreach ($kriterias as $kriteria)
                                        <th>{{ $kriteria->kode_kriteria }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alternatifs as $alternatif)
                                    <tr>
                                        <td class="text-center">{{ $alternatif->kode_alternatif }}</td>
                                        @foreach ($kriterias as $kriteria)
                                            <td class="text-center">
                                                {{ $alternatif->kriterias->where('id_kriteria', $kriteria->id_kriteria)->first()->pivot->nilai_rating ?? '-' }}
                                            </td>
                                        @endforeach
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
