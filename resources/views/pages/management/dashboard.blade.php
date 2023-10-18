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
                    <a href="{{ route('management-kelas') }}" class="card-box-footer">View More <i
                            class="fa fa-arrow-circle-right"></i></a>
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
                    <a href="{{ route('management-siswa') }}" class="card-box-footer">View More <i
                            class="fa fa-arrow-circle-right"></i></a>
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
                    <a href="{{ route('absen.index') }}" class="card-box-footer">View More <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 mt-5">
                <div class="card-box bg-orange">
                    <div class="inner">
                        <h3> {{ number_format($persentaseKehadiran) }}% </h3>
                        <p style="color: #fff"> Persentase Kehadiran Bulan Ini </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-chart-pie"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 mt-5">
                <div class="card-box bg-orange">
                    <div class="inner">
                        <h3> {{ number_format($totalPelanggaran) }} </h3>
                        <p style="color: #fff"> Jumlah Pelanggaran Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Persentase Kehadirna Bulan Ini
                    </h6>

                </div>
                <div class="card-body">
                    <div class="pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('addon-script')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            // Data untuk grafik pie
            var persentaseKehadiran = {!! $persentaseKehadiran !!};

            var data = {
                labels: ["Hadir", "Tidak Hadir"],
                datasets: [{
                    data: [persentaseKehadiran, 100 - persentaseKehadiran], // Menggunakan perhitungan selisih
                    backgroundColor: ["#33FF57", "#FF5733"]
                }]
            };

            // Inisialisasi grafik
            var ctx = document.getElementById('myPieChart').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: data
            });
        </script>
    @endpush
@endsection
