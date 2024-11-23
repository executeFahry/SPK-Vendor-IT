@extends('layout')

@section('title', 'Edit Data Alternatif')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Form Edit Alternatif</div>
        </div>

        <form action="{{ route('alternatif.update', $alternatif->id_alternatif) }}" method="POST" class="needs-validation"
            novalidate>
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="kode_alternatif" class="form-label">Kode Alternatif</label>
                        <input type="text" class="form-control" name="kode_alternatif"
                            value="{{ $alternatif->kode_alternatif }}" required maxlength="4">
                        <div class="invalid-feedback">Silakan isi Kode Alternatif dengan benar.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="nama_vendor" class="form-label">Nama Vendor</label>
                        <input type="text" class="form-control" name="nama_vendor" value="{{ $alternatif->nama_vendor }}"
                            required maxlength="150">
                        <div class="invalid-feedback">Silakan isi Nama Vendor dengan benar.</div>
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    @foreach ($kriterias as $kriteria)
                        <div class="col-md-6">
                            <label for="kriteria_{{ $kriteria->id_kriteria }}" class="form-label">
                                {{ $kriteria->nama_kriteria }}
                                <small class="text-muted">({{ ucfirst($kriteria->keterangan) }})</small>
                            </label>
                            @if ($kriteria->kode_kriteria === 'C1')
                                <!-- Input khusus untuk pengalaman menangani proyek IT -->
                                <input type="number" class="form-control" name="kriteria[{{ $kriteria->id_kriteria }}]"
                                    value="{{ $alternatif->kriterias->where('id_kriteria', $kriteria->id_kriteria)->first()?->pivot->nilai_rating }}"
                                    placeholder="Masukkan pengalaman menangani proyek IT (tahun)" required min="0">
                            @elseif ($kriteria->keterangan === 'cost' || $kriteria->keterangan === 'benefit')
                                <!-- Dropdown untuk kriteria lainnya -->
                                <select class="form-select" name="kriteria[{{ $kriteria->id_kriteria }}]" required>
                                    <option disabled value="">Pilih {{ $kriteria->nama_kriteria }}...</option>
                                    <option value="Tidak Baik"
                                        {{ $alternatif->kriterias->where('id_kriteria', $kriteria->id_kriteria)->first()?->pivot->nilai_rating == 1 ? 'selected' : '' }}>
                                        Tidak Baik</option>
                                    <option value="Cukup Baik"
                                        {{ $alternatif->kriterias->where('id_kriteria', $kriteria->id_kriteria)->first()?->pivot->nilai_rating == 2 ? 'selected' : '' }}>
                                        Cukup Baik</option>
                                    <option value="Baik"
                                        {{ $alternatif->kriterias->where('id_kriteria', $kriteria->id_kriteria)->first()?->pivot->nilai_rating == 3 ? 'selected' : '' }}>
                                        Baik</option>
                                    <option value="Sangat Baik"
                                        {{ $alternatif->kriterias->where('id_kriteria', $kriteria->id_kriteria)->first()?->pivot->nilai_rating == 4 ? 'selected' : '' }}>
                                        Sangat Baik</option>
                                </select>
                            @endif
                            <div class="invalid-feedback">Silakan isi {{ $kriteria->nama_kriteria }} dengan benar.</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Edit</button>
                <a href="{{ route('alternatif.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

    <script>
        (() => {
            "use strict";

            const forms = document.querySelectorAll(".needs-validation");
            Array.from(forms).forEach((form) => {
                form.addEventListener("submit", (event) => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add("was-validated");
                }, false);
            });
        })();
    </script>
@endsection
