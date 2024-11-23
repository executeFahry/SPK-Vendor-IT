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
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">List Alternatif Terdaftar</h3>
                        <a href="{{ route('alternatif.create') }}" class="btn btn-primary btn-sm float-end">Tambah
                            Alternatif</a>
                    </div>
                    <!-- /.card-header -->
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
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($alternatifs as $alternatif)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td class="text-center">{{ $alternatif->kode_alternatif }}</td>
                                        <td>{{ $alternatif->nama_vendor }}</td>
                                        @foreach ($kriterias as $kriteria)
                                            @php
                                                // Mendapatkan nilai dari tabel alternatif_kriteria
                                                $pivot = $alternatif->kriterias
                                                    ->where('id_kriteria', $kriteria->id_kriteria)
                                                    ->first();
                                                $nilaiRating = $pivot ? $pivot->pivot->nilai_rating : '-';

                                                // Khusus untuk "Pengalaman Menangani Proyek IT"
                                                if ($kriteria->kode_kriteria === 'C1') {
                                                    $verbalRating =
                                                        $nilaiRating !== '-' ? $nilaiRating . ' tahun' : '-';
                                                } else {
                                                    // Ubah nilai rating ke keterangan verbal
                                                    $verbalRating =
                                                        $nilaiRating !== '-' && isset($ratingDescriptions[$nilaiRating])
                                                            ? $ratingDescriptions[$nilaiRating]
                                                            : '-';
                                                }
                                            @endphp
                                            <td class="text-center">
                                                {{ $verbalRating }}
                                            </td>
                                        @endforeach
                                        <td class="text-center">
                                            <a href="{{ route('alternatif.edit', $alternatif->id_alternatif) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <span class="mx-1"></span>
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
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $alternatifs->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
