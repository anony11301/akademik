@extends('layouts.dashboard')
@section('page-content')
    <form action="{{ route('siswa.store', $id_kelas) }}" method="POST" id="siswa-form">
        @csrf
        <div class="card px-5 py-5 container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input class="form-control" type="text" name="nisn" placeholder="NISN" aria-label="NISN">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input class="form-control" type="text" name="nama" placeholder="Nama" aria-label="Nama">
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-success w-full mt-5 mb-3" data-toggle="modal"
                data-target="#konfirmasiModal">Simpan</button>
            <a href="{{ route('management-siswa') }}" class="btn btn-primary w-full">Kembali</a>

        </div>

        <!-- modal -->
        <div class="modal fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-labelledby="konfirmasiModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Tambah Data Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menambahkan data siswa ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
