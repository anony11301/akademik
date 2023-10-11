@extends('layouts.dashboard')

@section('page-content')
    <div class="container-fluid">
        <h1 class="mb-4">Data Kelas</h1>
        <form action="" method="get">
            <div class="row mb-3">
                <div class="col-md-3 form-group">
                    <label for="date_from">Dari Tanggal</label>
                    <input type="date" name="date_from" class="form-control" value="{{ $request->date_from }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="date_to">Sampai Tanggal</label>
                    <input type="date" name="date_to" class="form-control" value="{{ $request->date_to }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="status_filter">Filter Status</label>
                    <select class="form-control" name="status_filter" id="status_filter">
                        <option value="">Semua</option>
                        <option value="hadir" {{ $request->input('status_filter') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="sakit" {{ $request->input('status_filter') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="izin" {{ $request->input('status_filter') == 'izin' ? 'selected' : '' }}>Izin</option>
                        <option value="alpha" {{ $request->input('status_filter') == 'alpha' ? 'selected' : '' }}>Alpha</option>
                    </select>
                </div>
                <div class="col-md-1 mt-4 p-2">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
                <div class="col-md-1 mt-4 p-2">
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
                        <th scope="col">NIS</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Status</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($absen as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->NIS }}</td>
                            <td>{{ $siswa->where('NIS', $item->NIS)->first()->nama }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ $item->tanggal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
