@extends('layouts.dashboard')

@section('page-content')
<div class="flex card mx-4 px-4 py-4 my-5">
    <h1 style="color: black">Data Kelas

        <a href="{{ url('excel-export') }}" class="btn btn-sm btn-success float-right mr-2">Export Data</a>

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
                <div class="col-md-2 form-group" style="margin-top:25px;">
                    <label for="status_filter">Filter Status</label>
                    <select class="form-control" name="status_filter" id="status_filter">
                        <option value="">Semua</option>
                        <option value="hadir" {{ $request->input('status_filter') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="sakit" {{ $request->input('status_filter') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="izin" {{ $request->input('status_filter') == 'izin' ? 'selected' : '' }}>Izin</option>
                        <option value="alpha" {{ $request->input('status_filter') == 'alpha' ? 'selected' : '' }}>Alpha</option>
                    </select>
                </div>


            </div>
            <div class="col-md-5 form-group">
                <label for="date_to">Sampai Tanggal</label>
                <input type="date" name="date_to" class="form-control" value="{{ $request->date_to }}">
            </div>
            <div class="col-md-2 form-group mt-4">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
            <div class="col-md-2 form-group mt-4">
                <label for="status_filter">Filter Status</label>
                <select class="form-control" name="status_filter" id="status_filter">
                    <option value="">Semua</option>
                    <option value="hadir" {{ $request->input('status_filter') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="sakit" {{ $request->input('status_filter') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                    <option value="izin" {{ $request->input('status_filter') == 'izin' ? 'selected' : '' }}>Izin</option>
                    <option value="alpha" {{ $request->input('status_filter') == 'alpha' ? 'selected' : '' }}>Alpha</option>
                </select>
            </div>
        </div>
    </form>
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
    </div>
</div>
@endsection
