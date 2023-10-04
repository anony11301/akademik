@extends('layouts.dashboard')
@section('page-content')
<div class="container">
    <h1>Daftar Kelas</h1>
    <div class="row">
        @foreach($kelas as $kelas)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $kelas->nama_kelas }}</h5>
                    <p class="card-text">{{ $kelas->deskripsi }}</p>
                    <a href="{{ route('absen.create', ['kelas_id' => $kelas->id]) }}" class="btn btn-primary">Lihat Siswa</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection