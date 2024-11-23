@extends('layout')

@section('title', 'Data Kriteria')

@section('content')
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">List Kriteria Terdaftar</h3>
                        <a href="{{ route('kriteria.create') }}" class="btn btn-primary btn-sm float-end">Tambah
                            Kriteria</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 15px">#</th>
                                    <th>Kode Kriteria</th>
                                    <th>Nama Kriteria</th>
                                    <th>Bobot</th>
                                    <th>Keterangan</th>
                                    <th style="max-width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($kriterias as $kriteria)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $kriteria->kode_kriteria }}</td>
                                        <td>{{ $kriteria->nama_kriteria }}</td>
                                        <td>{{ $kriteria->nilai_bobot }}</td>
                                        <td>{{ ucfirst($kriteria->keterangan) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('kriteria.edit', $kriteria->id_kriteria) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <span class="mx-1"></span>
                                            <form action="{{ route('kriteria.destroy', $kriteria->id_kriteria) }}"
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
                        {{ $kriterias->links('pagination::bootstrap-5') }}
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
