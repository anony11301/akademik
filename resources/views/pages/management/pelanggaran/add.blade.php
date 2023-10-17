@extends('layouts.dashboard')
@section('page-content')
    <form action="{{ route('save-pelanggaran') }}" method="POST" id="kelas-form">
        @csrf
        <div class="card px-5 py-5 container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tingkat">Nama Pelanggaran</label>
                        <input type="text" name="nama_pelanggaran" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jurusan">Poin</label>
                        <input type="number" name="poin" class="form-control">
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-success w-full mt-5 mb-3" data-toggle="modal"
                data-target="#konfirmasiModal">Simpan</button>
            <a href="{{ route('pelanggaran') }}" class="btn btn-primary w-full">Kembali</a>
        </div>

        <!-- modal -->
        <div class="modal fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-labelledby="konfirmasiModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Penambahan Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menambahkan data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection
