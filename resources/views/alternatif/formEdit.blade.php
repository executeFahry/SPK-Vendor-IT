@extends('layout')

@section('title', 'Edit Data Alternatif')

@section('content')
    <!--begin::Form Validation-->
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Form Edit Alternatif</div>
        </div>
        <!--end::Header-->

        <!--begin::Form-->
        <form action="{{ route('alternatif.update', $alternatif->id_alternatif) }}" method="POST" class="needs-validation"
            novalidate>
            @csrf
            @method('PUT')
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Row-->
                <div class="row g-3">
                    <!--begin::Col-->
                    <div class="col-md-6"> <label for="kode_alternatif" class="form-label">Kode Alternatif</label> <input
                            type="text" class="form-control" id="validationCustom01" name="kode_alternatif"
                            value="{{ $alternatif->kode_alternatif }}" required maxlength="4">
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6"> <label for="nama_vendor" class="form-label">Nama Vendor</label> <input
                            type="text" class="form-control" id="validationCustom01" name="nama_vendor"
                            value="{{ $alternatif->nama_vendor }}" required maxlength="50">
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6"> <label for="pengalaman_proyek" class="form-label">Pengalaman Proyek IT (tahun)</label>
                        <input type="number" class="form-control" id="validationCustom01" name="pengalaman_proyek"
                            value="{{ $alternatif->pengalaman_proyek }}" required maxlength="50">
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6">
                        <label for="kualitas_layanan" class="form-label">Kualitas Layanan</label>
                        <select class="form-select" id="kualitas_layanan" name="kualitas_layanan" required>
                            <option disabled value="">Pilih Kualitas Layanan...</option>
                            <option value="Tidak Baik"
                                {{ $alternatif->kualitas_layanan == 'Tidak Baik' ? 'selected' : '' }}>Tidak Baik</option>
                            <option value="Cukup Baik"
                                {{ $alternatif->kualitas_layanan == 'Cukup Baik' ? 'selected' : '' }}>Cukup Baik</option>
                            <option value="Baik" {{ $alternatif->kualitas_layanan == 'Baik' ? 'selected' : '' }}>Baik
                            </option>
                            <option value="Sangat Baik"
                                {{ $alternatif->kualitas_layanan == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                        </select>
                        <div class="invalid-feedback">Silakan pilih kualitas layanan yang valid.</div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6">
                        <label for="keamanan_layanan" class="form-label">Keamanan Layanan</label>
                        <select class="form-select" id="keamanan_layanan" name="keamanan_layanan" required>
                            <option disabled value="">Pilih keamanan Layanan...</option>
                            <option value="Tidak Baik"
                                {{ $alternatif->keamanan_layanan == 'Tidak Baik' ? 'selected' : '' }}>Tidak Baik</option>
                            <option value="Cukup Baik"
                                {{ $alternatif->keamanan_layanan == 'Cukup Baik' ? 'selected' : '' }}>Cukup Baik</option>
                            <option value="Baik" {{ $alternatif->keamanan_layanan == 'Baik' ? 'selected' : '' }}>Baik
                            </option>
                            <option value="Sangat Baik"
                                {{ $alternatif->keamanan_layanan == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                        </select>
                        <div class="invalid-feedback">Silakan pilih keamanan layanan yang valid.</div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6">
                        <label for="keahlian_teknis" class="form-label">Keahlian Teknis</label>
                        <select class="form-select" id="keahlian_teknis" name="keahlian_teknis" required>
                            <option disabled value="">Pilih Keahlian Teknis...</option>
                            <option value="Tidak Baik"
                                {{ $alternatif->keahlian_teknis == 'Tidak Baik' ? 'selected' : '' }}>Tidak Baik</option>
                            <option value="Cukup Baik"
                                {{ $alternatif->keahlian_teknis == 'Cukup Baik' ? 'selected' : '' }}>Cukup Baik</option>
                            <option value="Baik" {{ $alternatif->keahlian_teknis == 'Baik' ? 'selected' : '' }}>Baik
                            </option>
                            <option value="Sangat Baik"
                                {{ $alternatif->keahlian_teknis == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                        </select>
                        <div class="invalid-feedback">Silakan pilih keahlian teknis yang valid.</div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6">
                        <label for="keterlibatan_tim" class="form-label">Keterlibatan Tim</label>
                        <select class="form-select" id="keterlibatan_tim" name="keterlibatan_tim" required>
                            <option disabled value="">Pilih Keterlibatan Tim...</option>
                            <option value="Tidak Baik"
                                {{ $alternatif->keterlibatan_tim == 'Tidak Baik' ? 'selected' : '' }}>Tidak Baik</option>
                            <option value="Cukup Baik"
                                {{ $alternatif->keterlibatan_tim == 'Cukup Baik' ? 'selected' : '' }}>Cukup Baik</option>
                            <option value="Baik" {{ $alternatif->keterlibatan_tim == 'Baik' ? 'selected' : '' }}>Baik
                            </option>
                            <option value="Sangat Baik"
                                {{ $alternatif->keterlibatan_tim == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                        </select>
                        <div class="invalid-feedback">Silakan pilih keterlibatan tim yang valid.</div>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Body-->

            <!--begin::Footer-->
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Edit</button>
                <a href="{{ route('alternatif.index') }}" class="btn btn-secondary">Batal</a>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->

        <!--begin::JavaScript-->
        <script>
            // Disabling form submissions if there are invalid fields
            (() => {
                "use strict";

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms =
                    document.querySelectorAll(".needs-validation");

                // Loop over them and prevent submission
                Array.from(forms).forEach((form) => {
                    form.addEventListener(
                        "submit",
                        (event) => {
                            if (!form.checkValidity()) {
                                event.preventDefault();
                                event.stopPropagation();
                            }

                            form.classList.add("was-validated");
                        },
                        false
                    );
                });
            })();
        </script> <!--end::JavaScript-->
    </div> <!--end::Form Validation-->
@endsection
