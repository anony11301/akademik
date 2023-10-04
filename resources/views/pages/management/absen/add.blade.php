@extends('layouts.dashboard')
@section('page-content')
<div class="container">
    <h1>Daftar Siswa</h1>
    <form action="{{ route('absen.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal">
                </div>
            </div>
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $siswa)
                        <tr>
                            <td>{{ $siswa->NIS }}</td>
                            <td>{{ $siswa->nama }}</td>
                            <td>
                                <select name="status[]">
                                    <option value="hadir">Hadir</option>
                                    <option value="sakit">Sakit</option>
                                    <option value="izin">Izin</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="keterangan[]">
                                <input type="hidden" name="nis[]" value="{{ $siswa->NIS }}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <input type="hidden" name="kelas_id" value="{{ $kelas_id }}">
            </div>
        </div>
    </form>
</div>
@endsection