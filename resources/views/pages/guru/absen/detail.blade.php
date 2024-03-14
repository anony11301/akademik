@extends('layouts.dashboard')

@section('page-content')
    <div class="container-fluid">
        <div class="s-flex py-4">
            <h1 class="mb-4">Data Absensi Kelas {{ $nama_kelas }}</h1>
            <div class="d-flex flex-row-reveerse">
                <form action="{{ route('excel-export-absen', $kelas_id) }}" method="get">
                    <input type="hidden" name="date_from" value="{{ $request->date_from }}">
                    <input type="hidden" name="date_to" value="{{ $request->date_to }}">
                    <input type="hidden" name="status_filter" value="{{ $request->input('status_filter') }}">
                    <button type="submit" class="btn btn-sm btn-success float-right mr-2">Export Data</button>
                        </form>
            </div>

        </div>

        <form action="" method="get">
            <div class="row mb-3">
                <div class="col-md-3 form-group col-12">
                    <label for="date_from">Dari Tanggal</label>
                    <input type="date" name="date_from" class="form-control" value="{{ $request->date_from }}">
                </div>
                <div class="col-md-3 form-group col-12">
                    <label for="date_to">Sampai Tanggal</label>
                    <input type="date" name="date_to" class="form-control" value="{{ $request->date_to }}">
                </div>
                <div class="col-md-3 form-group col-12">
                    <label for="status_filter">Filter Status</label>
                    <select class="form-control" name="status_filter" id="status_filter">
                        <option value="">Semua</option>
                        <option value="hadir" {{ $request->input('status_filter') == 'hadir' ? 'selected' : '' }}>Hadir
                        </option>
                        <option value="tidak-hadir"
                            {{ $request->input('status_filter') == 'tidak-hadir' ? 'selected' : '' }}>Tidak Hadir
                        </option>
                        <option value="sakit" {{ $request->input('status_filter') == 'sakit' ? 'selected' : '' }}>Sakit
                        </option>
                        <option value="izin" {{ $request->input('status_filter') == 'izin' ? 'selected' : '' }}>Izin
                        </option>
                        <option value="alpha" {{ $request->input('status_filter') == 'alpha' ? 'selected' : '' }}>Alpha
                        </option>
                    </select>
                </div>
                <div class="col-md-1 mt-4 p-2 col-12">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
                <div class="col-md-1 mt-4 p-2 col-12">
                    <a href="{{ route('absen.show', ['id' => $kelas_id]) }}" class="btn btn-danger w-100">Reset</a>
                </div>
            </div>
        </form>
        <div class="mb-3">
            <h5>Presentase Kehadiran: {{ number_format($persentasi_kehadiran) }}%</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NISN</th>
                        <th scope="col" style="white-space: nowrap">Nama Siswa</th>
                        <th scope="col">Status</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col" style="white-space: nowrap">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($absen as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->NISN }}</td>
                            <td style="white-space: nowrap">{{ optional($item->siswa)->nama }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td style="white-space: nowrap">{{ $item->tanggal }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
