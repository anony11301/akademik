@extends('layouts.dashboard')

@section('page-content')
    <div class="container-fluid">
        <h1 class="mb-4">Data Pelanggaran</h1>
        <a href="#" class="btn btn-sm btn-success float-right mr-2">Export Data</a>
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
                    @foreach ($siswa as $item)
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
