@extends('layouts.dashboard')
    @section('page-content')
    <div class="flex card mx-4 px-4 py-4 my-5">
        <h1 style="color: black">Data Kelas
            <form action="" method="get">
                 <div class="row">
                    <div class="col-md-5 form-group">
                        <label for="">Date From</label>
                        <input type="date" name="date_from" class="form-control" value="{{ $request->date_from }}">
                     </div>
                     <div class="col-md-5 form-group">
                        <label for="">Date From</label>
                        <input type="date" name="date_to" class="form-control" value="{{ $request->date_to }}">
                     </div>
                     <div class="col-md-2 form-group" style="margin-top:25px;">
                        <input type="submit" class="btn btn-primary" value="Search">
                     </div>
                 </div>
            </form>
        </h1>
        <table class="table table-hover">
            <thead style="color: black">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Status</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">tanggal</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($absen as $item)
                    @foreach ($siswa as $nama)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->NIS }}</td>
                    <td>{{ $nama->nama }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>{{ $item->tanggal }}</td>

                </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endsection
