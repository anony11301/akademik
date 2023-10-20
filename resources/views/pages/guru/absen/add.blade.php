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
                        <input type="date" class="form-control" name="tanggal" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="white-space: nowrap">NIS</th>
                                    <th style="white-space: nowrap">Nama</th>
                                    <th style="white-space: nowrap">Status</th>
                                    <th style="white-space: nowrap">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $siswa)
                                    <tr>
                                        <td style="white-space: nowrap">{{ $siswa->NIS }}</td>
                                        <td style="white-space: nowrap">{{ $siswa->nama }}</td>
                                        <td style="white-space: nowrap">
                                            <select class="form-control" name="status[]" style="width: 100px">
                                                <option value="hadir">Hadir</option>
                                                <option value="sakit">Sakit</option>
                                                <option value="izin">Izin</option>
                                                <option value="alpha">Alpha</option>
                                            </select>
                                        </td>
                                        <td style="white-space: nowrap">
                                            <input class="form-control" type="text" name="keterangan[]">
                                            <input type="hidden" name="nis[]" value="{{ $siswa->NIS }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="d-flex flex-row-reverse w-100">
                    <button type="submit" class="btn btn-success w-25">Simpan</button>
                    <input type="hidden" name="kelas_id" value="{{ $kelas_id }}">

                </div>

            </div>
        </form>
    </div>
@endsection
