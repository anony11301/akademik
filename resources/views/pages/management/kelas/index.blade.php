@extends('layouts.dashboard')
@section('page-content')
    <div class="d-flex card mx-4 px-4 py-4 my-5">
        <div style="color: black" class="py-4 ">
            <div class="h3">Data Kelas</div>

            @if (Auth::user()->id_level == 1)
                <a href="{{ route('management-tambah-kelas') }}" class="btn btn-sm btn-primary float-right">+ Tambah Data</a>
                <a href="{{ url('excel-export') }}" class="btn btn-sm btn-success float-right mr-2">Export Data</a>
            @else
                <a href="{{ url('excel-export') }}" class="btn btn-sm btn-success float-right mr-2">Export Data</a>
            @endif


        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead style="color: black">
                    <tr>
                        @if (Auth::user()->id_level == 1)
                            <th scope="col">#</th>
                            <th scope="col" style="white-space: nowrap">Nama Kelas</th>
                            <th scope="col">Aksi</th>
                        @else
                            <th scope="col">#</th>
                            <th scope="col">Nama Kelas</th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp

                    @foreach ($kelas as $item)
                        <tr>
                            @if (Auth::user()->id_level == 1)
                                <td>{{ $no++ }}</td>
                                <td style="white-space: nowrap">{{ $item->nama_kelas }}</td>
                                <td class="w-25">
                                    <div class="d-flex">
                                        <div class="w-50 mx-2 "> <a href="{{ route('edit-kelas', $item->id) }}"
                                                class="btn btn-sm btn-warning  w-100"><i
                                                    class="fa-solid fa-pen-to-square"></i></a></div>
                                        <div class="w-50 mx-2">
                                            <form action="{{ route('delete-kelas', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger  w-100"><i
                                                        class="fa-solid fa-trash-can"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            @else
                                <td class="w-50">{{ $no++ }}</td>
                                <td class="w-50">{{ $item->nama_kelas }}</td>
                            @endif

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
