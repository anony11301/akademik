@extends('layouts.dashboard')

@section('page-content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Data Pelanggaran</h1>
            <a href="{{ url('excel-export-pelanggaran') }}" class="btn btn-sm btn-success">Export Data</a>
        </div>
        <form action="" method="get">
            <div class="row mb-3">
                <div class="col-md-3 form-group">
                    <label for="date_from">Dari Tanggal</label>
                    <input type="date" name="date_from" class="form-control" id="date_from"
                        value="{{ $request->input('date_from') }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="date_to">Sampai Tanggal</label>
                    <input type="date" name="date_to" id="date_to" class="form-control"
                        value="{{ $request->input('date_to') }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="search">Cari</label>
                    <input type="text" name="search" class="form-control" id="search"
                        value="{{ $request->input('search') }}">
                </div>
                <div class="col-md-1 mt-4 p-2">
                    <button type="submit" class="btn btn-primary btn-block">Cari</button>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="white-space: nowrap">Nama</th>
                        <th style="white-space: nowrap">Kelas</th>
                        <th>Pelanggaran</th>
                        <th>Keterangan</th>
                        <th>Poin</th>
                        <th style="white-space: nowrap">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($filteredSiswa as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td style="white-space: nowrap">{{ $item->siswa->nama }}</td>
                            <td style="white-space: nowrap">{{ $item->kelas->nama_kelas }}</td>
                            <td>{{ $item->pelanggaran->nama_pelanggaran }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ $item->pelanggaran->poin }}</td>
                            <td style="white-space: nowrap">{{ $item->tanggal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
