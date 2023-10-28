@extends('layouts.dashboard')
@section('page-content')
    <div class="d-flex card mx-4 px-4 py-4 my-5">
        <div class="py-4" style="color: black">
            <div class="h3">Data Jenis Pelanggaran</div>
            <a href="{{ route('add-pelanggaran') }}" class="btn btn-sm btn-primary float-right mt-2">+ Tambah Data</a>
            <a href="{{ url('excel-export-jenis') }}" class="btn btn-sm btn-success float-right mr-2 mt-2">Export Data</a>
        </div>


        <div class="table-responsive">
            <table class="table table-hover">
                <thead style="color: black">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="white-space: nowrap">Nama Pelanggaran</th>
                        <th scope="col">Poin</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp

                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td style="white-space: nowrap">{{ $item->nama_pelanggaran }}</td>
                            <td>{{ $item->poin }}</td>
                            <td class="w-25">
                                <div class="d-flex">
                                    <div class="w-50 mx-2 "> <a href="{{ route('edit-pelanggaran', $item->id) }}"
                                            class="btn btn-sm btn-warning  w-100"><i
                                                class="fa-solid fa-pen-to-square"></i></a></div>
                                    <div class="w-50 mx-2">
                                        <form action="{{ route('delete-pelanggaran', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger  w-100"><i
                                                    class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
