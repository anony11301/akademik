@extends('layouts.dashboard')
@section('page-content')
<form action="{{ route('update-kelas', $kelas->id) }}" method="POST" id="kelas-form">
    @csrf
    <div class="card px-5 py-5 container mt-5">
        <p class="my-2"><b style="color: black">Kelas Yang Diedit : {{ $kelas->nama_kelas }}</b></p>
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
                        <option value="PPLG">Pemodelan Perangkat Lunak dan Gim (PPLG)</option>
                        <option value="DKV">Desain Komunikasi Visual (DKV)</option>
                        <option value="TJKT">Teknik Jaringan Komputer dan Telekomunikasi (TJKT)</option>
                        <option value="BCF">Broadcasting Film (BCF)</option>
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
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-warning w-full mt-5 mb-3" data-toggle="modal" data-target="#konfirmasiModal">Edit</button>
        <a href="{{ route('management-kelas') }}" class="btn btn-primary w-full">Kembali</a>

    </div>
    <!-- modal -->
    <div class="modal fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
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