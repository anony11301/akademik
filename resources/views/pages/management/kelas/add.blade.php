@extends('layouts.dashboard')
@section('page-content')
<form action="{{ route('kelas.store') }}" method="POST" id="kelas-form">
    @csrf
    <div class="card px-5 py-5 container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tingkat">Tingkat</label>
                    <select class="form-control" id="tingkat" name="tingkat">
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <select class="form-control" id="jurusan" name="jurusan">
                        <option value="RPL">Rekaya Perangkat Lunak (RPL)</option>
                        <option value="MM">Multimedia (MM)</option>
                        <option value="TKJ">Teknik Komputer Jaringan (TKJ)</option>
                        <option value="BC">Broadcasting (BC)</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="rombel">Rombel</label>
                    <select class="form-control" id="rombel" name="rombel">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-success w-full mt-5 mb-3" data-toggle="modal" data-target="#konfirmasiModal">Simpan</button>
        <a href="{{ route('management-kelas') }}" class="btn btn-primary w-full">Kembali</a>
    </div>

    <!-- modal -->
    <div class="modal fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Penambahan Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menambahkan data kelas ini?
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