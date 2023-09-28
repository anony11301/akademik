@extends('layouts.dashboard')
@section('page-content')
    <div class="flex card mx-4 px-4 py-4 my-5">
        <h1 style="color: black">Data Kelas</h1>
        <table class="table table-hover">
            <thead style="color: black">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Kelas</th>
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
                        <td class="w-25">
                            <div class="row w-full">
                                <div class="w-25 mx-2">
                                    <a href="{{ route('edit-kelas', $item->id) }}"
                                        class="btn btn-sm btn-warning w-100">Edit</a>
                                </div>
                                <div class="w-25 mx-2">
                                    <form action="{{ route('delete-kelas', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger w-100">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="flex card mx-4 px-4 py-4">
        <a href="{{ url('dashboard-management-tambah-kelas') }}" class="btn btn-primary w-full">+ Tambah Data</a>
        <a href="" class="btn btn-success w-full mt-4">Export Data</a>
    </div>
@endsection
