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
                        <th scope="col">NIS</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Pelanggaran</th>
                        <th scope="col">Poin</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data_pelanggaran as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->NIS }}</td>
                            <td>{{ $data_pelanggaran->where('NIS', $item->NIS)->first()->nama }}</td>
                            <td>{{ $item->kelas }}</td>
                            <td>{{ $item->pelanggaran }}</td>
                            <td>{{ $item->poin }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
