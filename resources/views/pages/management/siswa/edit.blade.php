@extends('layouts.dashboard')
@section('page-content')
    <form action="{{ route('update-siswa', $siswa->NISN) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card px-5 py-5 container mt-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="NISN">NISN</label>
                        <input type="text" name="NISN" class="form-control" value="{{ $siswa->NISN }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $siswa->nama }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" class="form-control">
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}" {{ $siswa->id_kelas == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-warning w-full mt-5 mb-3" data-toggle="modal"
                data-target="#konfirmasiModal">Edit</button>
            <a href="{{ route('management-siswa') }}" class="btn btn-primary w-full">Kembali</a>
        </div>

        <!-- modal -->
        <div class="modal fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-labelledby="konfirmasiModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Edit Data Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menyimpan perubahan data siswa ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
