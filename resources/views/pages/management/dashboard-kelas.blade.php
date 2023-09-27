@extends('layouts.dashboard')
@section('page-content')
    <div class="flex card mx-4 px-4 py-4">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Kelas</th>
                    <th scope="col">Jurusan</th>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
