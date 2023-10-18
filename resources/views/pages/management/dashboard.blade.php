@extends('layouts.dashboard')

@section('page-content')
<!-- Begin Page Content -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="/css/dashboard.css" type="text/css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-orange">
                <div class="inner">
                    <h3> {{ $jumlahKelas }} </h3>
                    <p style="color: #fff"> Data Kelas </p>
                </div>
                <div class="icon">
                    <i class="fa fa-school" aria-hidden="true"></i>
                </div>
                <a href="{{ route('management-kelas') }}" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-orange">
                <div class="inner">
                    <h3> {{ $jumlahSiswa }} </h3>
                    <p style="color: #fff"> Data Siswa </p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('management-siswa') }}" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-orange">
                <div class="inner">
                    <h3> {{ $jumlahSiswa }} </h3>
                    <p style="color: #fff"> Data Absen </p>
                </div>
                <div class="icon">
                    <i class="fa fa-book"></i>
                </div>
                <a href="{{ route('absen.index') }}" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 mt-5">
            <div class="card-box bg-orange">
                <div class="inner">
                    <h3> {{ number_format($persentaseKehadiran) }}% </h3>
                    <p style="color: #fff"> Persentase Kehadiran </p>
                </div>
                <div class="icon">
                    <i class="fa fa-chart-pie"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 mt-5">
            <div class="card-box bg-orange">
                <div class="inner">
                    <h3> {{ number_format($persentaseKehadiran) }}% </h3>
                    <p style="color: #fff"> Persentase Kehadiran </p>
                </div>
                <div class="icon">
                    <i class="fa fa-chart-pie"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection