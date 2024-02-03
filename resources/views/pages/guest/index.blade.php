@extends('layouts.app')

@section('page-content')
    <div class="container vh-100">
        <div class="row my-5">
            <div class="col-xl-4 col-lg-5">
                <div class="card h-100 justify-content-center shadow">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Persentase Kehadiran SMK Bulan Ini
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-5">
                <div class="card h-100 justify-content-center shadow">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Jumlah Pelanggaran Tahun Ini
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <canvas id="myLineChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-12">
                <div class="card h-100 justify-content-center shadow">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Persentase Kehadiran Berdasarkan Kelas dan Bulan ini
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <canvas id="myBarChart" class="w-100 h-100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <form action="" method="get">
            <div class="row">
                <div class="col-md-4 form-group col-12">
                    <label for="date_from">Dari Tanggal</label>
                    <input type="date" name="date_from" class="form-control" value="{{ $request->date_from }}">
                </div>
                <div class="col-md-4 form-group col-12">
                    <label for="date_to">Sampai Tanggal</label>
                    <input type="date" name="date_to" class="form-control" value="{{ $request->date_to }}">
                </div>
                <div class="col-md-2 mt-4 p-2 col-12">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
                <div class="col-md-2 mt-4 p-2 col-12">
                    <a href="{{ route('absensi') }}"
                        class="btn btn-danger w-100">Reset</a>
                </div>
            </div>
        </form>

        <div class="row mb-5 mt-2">
            <div class="col-xl-4 col-lg-5">
                <div class="card h-100 justify-content-center shadow">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Persentase Kehadiran SMK per Tanggal
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <canvas id="pieChartDate"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-5">
                <div class="card h-100 justify-content-center shadow">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Persentase Kehadiran Berdasarkan Kelas dan Tanggal
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <canvas id="barChartDate" class="w-100 h-100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row py-5">
            @foreach ($kelas as $item)
                <div class="col col-12 col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 w-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col">
                                    <div class="h5 mb-0 font-weight-bold text-warning">{{ $item->nama_kelas }}</div>
                                    @if ($jumlahAbsen[$item->id] > 0)
                                        <small class="text-muted">Tidak Hadir: {{ $jumlahTidakHadir[$item->id] }}</small>
                                    @else
                                        <small class="text-danger">Tidak Hadir: {{ $jumlahTidakHadir[$item->id] }}</small>
                                    @endif
                                </div>
                                <div class="col-auto">
                                    <div class="col-auto">
                                        <a href="{{ route('absensi-detail', $item->id) }}"><i
                                                class="fas fa-arrow-right fa-2x text-gray-300"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
            // Data untuk grafik pelanggaran
            var ctx = document.getElementById('myLineChart').getContext('2d');
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?= json_encode($labels) ?>,
                    datasets: [{
                        label: 'Jumlah Pelanggaran',
                        data: <?= json_encode($data) ?>,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var dataBar = {
                labels: {!! json_encode($labelkelas) !!},
                datasets: [{
                    label: 'Jumlah Kehadian (%)',
                    data: {!! json_encode($persentasekelas) !!},
                    backgroundColor: "#FFC107",
                    borderColor: "#FFA000",
                    borderWidth: 1
                }]
            };
            var ctxBar = document.getElementById('myBarChart').getContext('2d');
            var myBarChart = new Chart(ctxBar, {
                type: 'bar',
                data: dataBar,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            //chart absen sekolah sesuai date
            var datadate = {
                labels: ["Hadir (%)", "Tidak Hadir (%)"],
                datasets: [{
                    data: [{!! $persentaseDate !!}, 100 -
                    {!! $persentaseDate !!}],
                    backgroundColor: ["#33FF57", "#FF5733"]
                }]
            };

            var ctx = document.getElementById('pieChartDate').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: datadate
            });


            //chart absen per kelas sesuai date
            var dataBarDate = {
                labels: {!! json_encode($labelKelasDate) !!},
                datasets: [{
                    label: 'Jumlah Kehadian (%)',
                    data: {!! json_encode($persentaseKelasDate) !!},
                    backgroundColor: "#FFC107",
                    borderColor: "#FFA000",
                    borderWidth: 1
                }]
            };

            var ctxBar = document.getElementById('barChartDate').getContext('2d');
            var myBarChart = new Chart(ctxBar, {
                type: 'bar',
                data: dataBarDate,
                options: {
                    scales: {
                        x: {
                            ticks: {
                                font: {
                                    size: 10
                                }
                            }
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        </script>
    @endpush
@endsection
