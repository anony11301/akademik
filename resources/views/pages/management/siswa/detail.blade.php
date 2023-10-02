@extends('layouts.dashboard')
@section('page-content')
    <div class="flex card mx-4 px-4 py-4 my-5">
        <h1 style="color: black">Data Kelas

            <a href="{{ url('management-tambah-kelas') }}" class="btn btn-sm btn-primary float-right">+ Tambah Data</a>
            <a href="{{ url('excel-export') }}" class="btn btn-sm btn-success float-right mr-2">Export Data</a>

        </h1>
        <table class="table table-hover">
            <thead style="color: black">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Aksi</th>
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
                        <td>{{ $item->nama }}</td>
                        <td class="w-25">
                            <div class="d-flex">
                                <div class="w-50 mx-2 "> <a href="{{ route('edit-kelas', $item->NIS) }}"
                                        class="btn btn-sm btn-warning  w-100">Edit</a></div>
                                <div class="w-50 mx-2">
                                    <form action="{{ route('delete-kelas', $item->NIS) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger  w-100">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
