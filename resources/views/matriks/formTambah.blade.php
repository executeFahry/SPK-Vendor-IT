@extends('layout')

@section('title', 'Tambah Matriks Keputusan')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Matriks Keputusan</h3>
                    </div>
                    <form action="{{ route('matriks.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="id_alternatif" class="form-label">Alternatif</label>
                                <select name="id_alternatif" class="form-select" required>
                                    <option value="" disabled selected>Pilih Alternatif</option>
                                    @foreach ($alternatifs as $alternatif)
                                        <option value="{{ $alternatif->id_alternatif }}">{{ $alternatif->kode_alternatif }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="id_kriteria" class="form-label">Kriteria</label>
                                <select name="id_kriteria" class="form-select" required>
                                    <option value="" disabled selected>Pilih Kriteria</option>
                                    @foreach ($kriterias as $kriteria)
                                        <option value="{{ $kriteria->id_kriteria }}">{{ $kriteria->kode_kriteria }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nilai_rating" class="form-label">Nilai Rating</label>
                                <input type="number" name="nilai_rating" id="nilai_rating" class="form-control"
                                    min="1" max="4" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('matriks.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
