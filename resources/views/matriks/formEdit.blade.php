@extends('layout')

@section('title', 'Edit Matriks Keputusan')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit Matriks Keputusan</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ route('matriks.update', $matriks->id_matriks) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="id_alternatif" class="form-label">Alternatif</label>
                                <select name="id_alternatif" class="form-select" required>
                                    @foreach ($alternatifs as $alternatif)
                                        <option value="{{ $alternatif->id_alternatif }}"
                                            @if ($alternatif->id_alternatif == $matriks->id_alternatif) selected @endif>
                                            {{ $alternatif->kode_alternatif }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="id_kriteria" class="form-label">Kriteria</label>
                                <select name="id_kriteria" class="form-select" required>
                                    @foreach ($kriterias as $kriteria)
                                        <option value="{{ $kriteria->id_kriteria }}"
                                            @if ($kriteria->id_kriteria == $matriks->id_kriteria) selected @endif>
                                            {{ $kriteria->kode_kriteria }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nilai_rating" class="form-label">Nilai Rating</label>
                                <input type="number" name="nilai_rating" id="nilai_rating" class="form-control"
                                    min="1" max="4" value="{{ $matriks->nilai_rating }}" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('matriks.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
