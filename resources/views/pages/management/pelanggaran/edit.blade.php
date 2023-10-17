@extends('layouts.dashboard')
@section('page-content')
    <form action="{{ route('update-pelanggaran', $data->id) }}" method="POST" id="kelas-form">
        @csrf
        <div class="card px-5 py-5 container mt-5">
            <p class="my-2"><b style="color: black">Pelanggaran Yang Diedit : {{ $data->nama_pelanggaran }}</b></p>
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tingkat">Nama Pelanggaran</label>
                        <input type="text" name="nama_pelanggaran" class="form-control"
                            value="{{ $data->nama_pelanggaran }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jurusan">Poin</label>
                        <input type="number" name="poin" class="form-control" value="{{ $data->poin }}">
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-warning w-full mt-5 mb-3" data-toggle="modal"
                data-target="#konfirmasiModal">Edit</button>
            <a href="{{ route('pelanggaran') }}" class="btn btn-primary w-full">Kembali</a>

        </div>
        <!-- modal -->
        <div class="modal fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-labelledby="konfirmasiModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menyimpan perubahan data kelas ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection
