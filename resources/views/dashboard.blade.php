@extends('layout')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3>{{ $totalAlternatif }}</h3>
                    <p>Alternatif</p>
                </div>
                <a href="{{ url('alternatif') }}" class="small-box-footer">Lebih Lanjut <i class="bi bi-link-45deg"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3>{{ $totalKriteria }}</h3>
                    <p>Kriteria</p>
                </div>
                <a href="{{ url('kriteria') }}" class="small-box-footer">Lebih Lanjut <i class="bi bi-link-45deg"></i></a>
            </div>
        </div>
    </div>
@endsection
