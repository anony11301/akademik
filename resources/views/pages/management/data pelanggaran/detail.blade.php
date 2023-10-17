@extends('layouts.dashboard')

@section('page-content')
    <div class="container-fluid">
        <h1 class="mb-4">Data Kelas</h1>
        <a href="#" class="btn btn-sm btn-success float-right mr-2">Export Data</a>
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
                    @foreach ($siswa as $item)
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
