@php
    // Mapping nilai_rating ke keterangan verbal
    $ratingDescriptions = [
        1 => 'Tidak Baik',
        2 => 'Cukup Baik',
        3 => 'Baik',
        4 => 'Sangat Baik',
    ];
@endphp

@extends('layout')

@section('title', 'Data Alternatif')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">List Alternatif Terdaftar</h3>
                        <a href="{{ route('alternatif.create') }}" class="btn btn-primary btn-sm float-end">Tambah
                            Alternatif</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 15px">#</th>
                                    <th>Kode Alternatif</th>
                                    <th>Nama Vendor</th>
                                    @foreach ($kriterias as $kriteria)
                                        <th>{{ $kriteria->nama_kriteria }}</th>
                                    @endforeach
                                    <th style="max-width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alternatifs as $key => $alternatif)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $alternatif->kode_alternatif }}</td>
                                        <td>{{ $alternatif->nama_vendor }}</td>
                                        @foreach ($kriterias as $kriteria)
                                            @php
                                                // Mendapatkan nilai dari relasi pivot alternatif_kriteria
                                                $pivot = $alternatif->kriterias->firstWhere(
                                                    'id_kriteria',
                                                    $kriteria->id_kriteria,
                                                );
                                                $nilaiRating = $pivot ? $pivot->pivot->nilai_rating : null;

                                                if ($kriteria->kode_kriteria === 'C1') {
                                                    // Format untuk Pengalaman Menangani Proyek IT
                                                    $verbalRating =
                                                        $nilaiRating !== null ? $nilaiRating . ' tahun' : '-';
                                                } else {
                                                    // Format nilai untuk kriteria lainnya
                                                    $verbalRating = isset($ratingDescriptions[$nilaiRating])
                                                        ? $ratingDescriptions[$nilaiRating]
                                                        : '-';
                                                }
                                            @endphp
                                            <td class="text-center">{{ $verbalRating }}</td>
                                        @endforeach
                                        <td class="text-center">
                                            <a href="{{ route('alternatif.edit', $alternatif->id_alternatif) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('alternatif.destroy', $alternatif->id_alternatif) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="bi bi-x-square"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $alternatifs->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
