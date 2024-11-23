@extends('layout')

@section('title', 'Edit Data Kriteria')

@section('content')
    <!--begin::Form Validation-->
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Form Edit Kriteria</div>
        </div>
        <!--end::Header-->

        <!--begin::Form-->
        <form action="{{ route('kriteria.update', $kriteria->id_kriteria) }}" method="POST" class="needs-validation"
            novalidate>
            @csrf
            @method('PUT')
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Row-->
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="kode_kriteria" class="form-label">Kode Kriteria</label>
                        <input type="text" class="form-control @error('kode_kriteria') is-invalid @enderror"
                            name="kode_kriteria" value="{{ $kriteria->kode_kriteria }}" required maxlength="4">
                        <div class="valid-feedback">Input Sesuai</div>
                        @error('kode_kriteria')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                        <input type="text" class="form-control" id="validationCustom01" name="nama_kriteria"
                            value="{{ $kriteria->nama_kriteria }}" required>
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                    <div class="col-md-6">
                        <label for="nilai_bobot" class="form-label">Bobot</label>
                        <input type="text" class="form-control" id="validationBobot" name="nilai_bobot"
                            value="{{ $kriteria->nilai_bobot }}" required pattern="^\d+([.,]\d+)?$">
                        <div class="valid-feedback">Input Sesuai</div>
                        <div class="invalid-feedback">Bobot harus berupa angka atau desimal (contoh: 3.5 atau 4,5).</div>
                    </div>
                    <div class="col-md-6">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <div>
                            <label>
                                <input type="radio" name="keterangan" value="benefit"
                                    {{ $kriteria->keterangan == 'benefit' ? 'checked' : '' }}> Benefit
                            </label>
                            <label>
                                <input type="radio" name="keterangan" value="cost"
                                    {{ $kriteria->keterangan == 'cost' ? 'checked' : '' }}> Cost
                            </label>
                        </div>
                    </div>

                </div>
                <!--end::Row-->
            </div>
            <!--end::Body-->

            <!--begin::Footer-->
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Edit</button>
                <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">Batal</a>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->
        <!--begin::JavaScript-->
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

                        const bobotInput = form.querySelector('#validationBobot');
                        const bobotValue = bobotInput.value;
                        if (!/^\d+([.,]\d+)?$/.test(bobotValue)) {
                            bobotInput.setCustomValidity(
                                'Bobot harus berupa angka atau desimal (contoh: 3.5 atau 4,5).');
                        } else {
                            bobotInput.setCustomValidity('');
                        }

                        form.classList.add("was-validated");
                    }, false);
                });
            })();
        </script>
        <!--end::JavaScript-->
    </div> <!--end::Form Validation-->
@endsection
