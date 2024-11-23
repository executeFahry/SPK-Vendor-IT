@extends('layout')

@section('title', 'Tambah Data Alternatif')

@section('content')
    <!--begin::Form Validation-->
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Form Tambah Alternatif</div>
        </div>
        <!--end::Header-->

        <!--begin::Form-->
        <form action="{{ route('alternatif.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Row-->
                <div class="row g-3">
                    <!--begin::Col-->
                    <div class="col-md-6"> <label for="kode_alternatif" class="form-label">Kode Alternatif</label> <input
                            type="text" class="form-control" id="validationCustom01" name="kode_alternatif" required>
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6"> <label for="nama_vendor" class="form-label">Nama Vendor</label> <input
                            type="text" class="form-control" id="validationCustom01" name="nama_vendor" required>
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6"> <label for="pengalaman_proyek" class="form-label">Pengalaman Proyek IT (tahun)</label>
                        <input type="number" class="form-control" id="validationCustom01" name="pengalaman_proyek"
                            required>
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6">
                        <label for="kualitas_layanan" class="form-label">Kualitas Layanan</label>
                        <select class="form-select" id="kualitas_layanan" name="kualitas_layanan" required>
                            <option selected disabled value="">Pilih Kualitas Layanan...</option>
                            <option value="Tidak Baik">Tidak Baik</option>
                            <option value="Cukup Baik">Cukup Baik</option>
                            <option value="Baik">Baik</option>
                            <option value="Sangat Baik">Sangat Baik</option>
                        </select>
                        <div class="invalid-feedback">Silakan pilih kualitas layanan yang valid.</div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6">
                        <label for="keamanan_layanan" class="form-label">Keamanan Layanan</label>
                        <select class="form-select" id="keamanan_layanan" name="keamanan_layanan" required>
                            <option selected disabled value="">Pilih Keamanan Layanan...</option>
                            <option value="Tidak Baik">Tidak Baik</option>
                            <option value="Cukup Baik">Cukup Baik</option>
                            <option value="Baik">Baik</option>
                            <option value="Sangat Baik">Sangat Baik</option>
                        </select>
                        <div class="invalid-feedback">Silakan pilih keamanan layanan yang valid.</div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6">
                        <label for="keahlian_teknis" class="form-label">Keahlian Teknis</label>
                        <select class="form-select" id="keahlian_teknis" name="keahlian_teknis" required>
                            <option selected disabled value="">Pilih Keahlian Teknis...</option>
                            <option value="Tidak Baik">Tidak Baik</option>
                            <option value="Cukup Baik">Cukup Baik</option>
                            <option value="Baik">Baik</option>
                            <option value="Sangat Baik">Sangat Baik</option>
                        </select>
                        <div class="invalid-feedback">Silakan pilih keahlian teknis yang valid.</div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6">
                        <label for="keterlibatan_tim" class="form-label">Keterlibatan Tim</label>
                        <select class="form-select" id="keterlibatan_tim" name="keterlibatan_tim" required>
                            <option selected disabled value="">Pilih Keterlibatan Tim...</option>
                            <option value="Tidak Baik">Tidak Baik</option>
                            <option value="Cukup Baik">Cukup Baik</option>
                            <option value="Baik">Baik</option>
                            <option value="Sangat Baik">Sangat Baik</option>
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
                <button class="btn btn-primary" type="submit">Tambah</button>
                <a href="{{ route('alternatif.index') }}" class="btn btn-secondary">Batal</a>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->

        <!--begin::JavaScript-->
        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
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
