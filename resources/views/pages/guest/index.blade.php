@extends('layouts.app')

@section('page-content')
    <div class="container vh-100">
        <div class="row my-5">
            <div class="col-xl-4 col-lg-5">
                <div class="card h-100 justify-content-center shadow">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Persentase Kehadiran Bulan Ini
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
        <div class="row py-5">
            @foreach ($kelas as $item)
                <div class="col col-12 col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 w-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col">
                                    <div class="h5 mb-0 font-weight-bold text-warning">{{ $item->nama_kelas }}</div>
                                    <small class="text-muted">Tidak Hadir: {{ $jumlahTidakHadir[$item->id] }}</small>
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
        </script>
    @endpush
@endsection
