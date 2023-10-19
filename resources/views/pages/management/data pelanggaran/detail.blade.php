@extends('layouts.dashboard')

@section('page-content')
    <div class="container-fluid">
        <h1 class="mb-4">Data Pelanggaran</h1>
        <a href="#" class="btn btn-sm btn-success float-right mr-2">Export Data</a>
        <form action="" method="get">
            <div class="row-mb-3">
                <div class="col-md-3 form-group">
                    <label for="date_from">Dari Tanggal</label>
                    <input type="date" name="date_from" class="form-control" value="{{ $request->input('date_from') }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="date_to">Sampai Tanggal</label>
                    <input type="date" name="date_to" class="form-control" value="{{ $request->input('date_to') }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="search">Cari</label>
                    <input type="text" name="search" class="form-control" value="{{ $request->input('search') }}">
                </div>
                <div class="col-md-1 mt-4 p-2">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Pelanggaran</th>
                        <th scope="col">Poin</th>
                        <th scope="col">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($filteredSiswa as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->siswa->nama }}</td>
                            <td>{{ $item->kelas->nama_kelas }}</td>
                            <td>{{ $item->pelanggaran->nama_pelanggaran }}</td>
                            <td>{{ $item->pelanggaran->poin }}</td>
                            <td>{{ $item->tanggal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
