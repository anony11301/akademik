@extends('layouts.dashboard')
@section('page-content')
    <div class="flex card mx-4 px-4 py-4 my-5">
        <h1 style="color: black">Data Kelas</h1>
        <table class="table table-hover">
            <thead style="color: black">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Kelas</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($kelas as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->nama_kelas }}</td>
                        <td>{{ $item->jurusan }}</td>
                        <td class="w-25"><a href="" class="btn btn-sm btn-warning mx-2 w-25">Edit</a><a
                                href="" class="btn btn-sm btn-danger mx-2 w-25">Hapus</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="flex card mx-4 px-4 py-4">
        <a href="" class="btn btn-primary w-full">+ Tambah Data</a>
    </div>
@endsection
